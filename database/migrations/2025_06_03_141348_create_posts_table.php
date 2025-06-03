<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Unique for SEO-friendly URLs
            $table->text('excerpt')->nullable(); // Short summary
            $table->longText('content'); // Full blog post content
            $table->string('image_path')->nullable(); // Path to the main image
            $table->timestamp('published_at')->nullable(); // When the post goes live
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};