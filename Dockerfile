# syntax = docker/dockerfile:experimental

ARG PHP_VERSION=8.3
ARG NODE_VERSION=18

# Stage 1: Base System and PHP Dependencies
# This stage sets up the OS, PHP, Composer, and other core tools.
FROM ubuntu:22.04 as base
LABEL fly_launch_runtime="laravel"

# PHP_VERSION needs to be repeated here for this stage
ARG PHP_VERSION
ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer \
    COMPOSER_MAX_PARALLEL_HTTP=24 \
    PHP_PM_MAX_CHILDREN=10 \
    PHP_PM_START_SERVERS=3 \
    PHP_MIN_SPARE_SERVERS=2 \
    PHP_MAX_SPARE_SERVERS=4 \
    PHP_DATE_TIMEZONE=UTC \
    PHP_DISPLAY_ERRORS=Off \
    PHP_ERROR_REPORTING=22527 \
    PHP_MEMORY_LIMIT=256M \
    PHP_MAX_EXECUTION_TIME=90 \
    PHP_POST_MAX_SIZE=100M \
    PHP_UPLOAD_MAX_FILE_SIZE=100M \
    PHP_ALLOW_URL_FOPEN=Off

# 1. Install PHP, Composer, and other system packages
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY .fly/php/ondrej_ubuntu_php.gpg /etc/apt/trusted.gpg.d/ondrej_ubuntu_php.gpg
ADD .fly/php/packages/${PHP_VERSION}.txt /tmp/php-packages.txt

RUN apt-get update \
    && apt-get install -y --no-install-recommends gnupg2 ca-certificates git-core curl zip unzip \
                                                  rsync vim-tiny htop sqlite3 nginx supervisor cron \
    && ln -sf /usr/bin/vim.tiny /etc/alternatives/vim \
    && ln -sf /etc/alternatives/vim /usr/bin/vim \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ondrej-ubuntu-php-focal.list \
    && apt-get update \
    && apt-get -y --no-install-recommends install $(cat /tmp/php-packages.txt) \
    && ln -sf /usr/sbin/php-fpm${PHP_VERSION} /usr/sbin/php-fpm \
    && mkdir -p /var/www/html/public && echo "index" > /var/www/html/public/index.php \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# 2. Copy static configuration files (Nginx, FPM, Supervisor)
COPY .fly/nginx/ /etc/nginx/
COPY .fly/fpm/ /etc/php/${PHP_VERSION}/fpm/
COPY .fly/supervisor/ /etc/supervisor/
COPY .fly/entrypoint.sh /entrypoint
COPY .fly/start-nginx.sh /usr/local/bin/start-nginx
RUN chmod 754 /usr/local/bin/start-nginx


# Stage 2: PHP Application Build
# This stage handles copying the application code and installing Composer dependencies.
FROM base as app_build_stage

# Set the working directory for the application
WORKDIR /var/www/html

# Copy application files and composer files early to leverage build cache
COPY composer.json composer.lock ./

# Install PHP dependencies with Composer
COPY . .
RUN composer install --optimize-autoloader --no-dev

# Copy the rest of the application code
COPY . /var/www/html

# Further application setup and optimization
RUN mkdir -p storage/logs \
    && php artisan optimize:clear \
    && chown -R www-data:www-data /var/www/html \
    && echo "MAILTO=\"\"\n* * * * * www-data /usr/bin/php /var/www/html/artisan schedule:run" > /etc/cron.d/laravel \
    && sed -i='' '/->withMiddleware(function (Middleware \$middleware) {/a\
        \$middleware->trustProxies(at: "*");\
    ' bootstrap/app.php; \
    if [ -d .fly ]; then cp .fly/entrypoint.sh /entrypoint; chmod +x /entrypoint; fi;

# Run Filament specific caching commands *after* Composer install and app code is copied
RUN php artisan icons:cache && php artisan filament:cache-components


# Stage 3: Frontend Asset Build (Node.js)
# This stage is for building JavaScript/CSS assets.
FROM node:${NODE_VERSION} as node_modules_build

# Create and set working directory for node build
RUN mkdir /app
WORKDIR /app

# Copy application files relevant for frontend build (e.g., package.json, vite.config.js)
COPY package.json package-lock.json ./

# Copy the entire app for frontend build, if necessary
# This ensures all source files for assets are available
COPY . .

# Copy vendor from the php build stage if your JS build relies on PHP files for config, etc.
# This might not always be strictly necessary for simple asset compilation.
COPY --from=app_build_stage /var/www/html/vendor /app/vendor

# Use yarn, pnpm, or npm to install dependencies and build assets
RUN if [ -f "vite.config.js" ]; then \
        ASSET_CMD="build"; \
    else \
        ASSET_CMD="production"; \
    fi; \
    if [ -f "yarn.lock" ]; then \
        yarn install --frozen-lockfile; \
        yarn $ASSET_CMD; \
    elif [ -f "pnpm-lock.yaml" ]; then \
        corepack enable && corepack prepare pnpm@latest-8 --activate; \
        pnpm install --frozen-lockfile; \
        pnpm run $ASSET_CMD; \
    elif [ -f "package-lock.json" ]; then \
        npm ci --no-audit; \
        npm run $ASSET_CMD; \
    else \
        npm install; \
        npm run $ASSET_CMD; \
    fi;


# Stage 4: Final Production Image
# Combines the base system, PHP application, and built assets.
FROM base

# Set working directory for the final image
WORKDIR /var/www/html

# Copy all PHP application files from the app_build_stage.
# This includes the 'vendor' directory and any files modified by artisan commands.
COPY --from=app_build_stage /var/www/html /var/www/html

# Merge generated static assets from the node_modules_build stage into the public directory
COPY --from=node_modules_build /app/public /var/www/html/public-npm
RUN rsync -ar /var/www/html/public-npm/ /var/www/html/public/ \
    && rm -rf /var/www/html/public-npm \
    && chown -R www-data:www-data /var/www/html/public

# Expose the application port
EXPOSE 8080

# Define the entrypoint for the container
ENTRYPOINT ["/entrypoint"]