<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post; // Import the Post model
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        // Fetch all published posts, ordered by published_at (newest first)
        $posts = Post::whereNotNull('published_at')
                     ->orderBy('published_at', 'desc')
                     ->paginate(9); // Paginate to show 9 posts per page

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(Post $post) // Laravel's Route Model Binding automatically fetches the post by slug
    {
        // Ensure the post is published before showing it
        if (!$post->published_at) {
            abort(404); // Or redirect
        }

        return view('blog.show', compact('post'));
    }
}