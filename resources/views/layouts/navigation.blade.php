<nav class="bg-accent text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- logo (later replace with actual logo, need to get from drive) -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-white">Algaeo</a>

     
            <div class="flex space-x-8">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-b-2 border-white' : '' }}">
                    Home
                </a>

                <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'border-b-2 border-white' : '' }}">
                    News and Articles
                </a>

                <a href="{{ route('tools.index') }}" class="{{ request()->routeIs('tools.*') ? 'border-b-2 border-white' : '' }}">
                    Tools
                </a>

                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'border-b-2 border-white' : '' }}">
                    About Us
                </a>

                <div class="relative group">
                    <a href="{{ route('shop.index') }}"
                    class="flex items-center hover:text-gray-200 {{ request()->routeIs('shop.*') ? 'border-b-2 border-white' : '' }}">
                        Shop
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <div class="absolute hidden group-hover:block bg-white text-gray-800 shadow-md rounded mt-2 w-48 z-50">
                        <a href="{{ route('shop.account') }}" class="block px-4 py-2 hover:bg-gray-100">My Account</a>
                        <a href="{{ route('shop.checkout') }}" class="block px-4 py-2 hover:bg-gray-100">Checkout</a>
                        <a href="{{ route('shop.cart') }}" class="block px-4 py-2 hover:bg-gray-100">Cart</a>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</nav>

