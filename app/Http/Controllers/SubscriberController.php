<?php

namespace App\Http\Controllers;

use App\Models\Subscriber; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Optional: For logging

class SubscriberController extends Controller
{
    /**
     * Store a new subscriber email in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        // 'email' is required, must be a valid email format, unique in the 'subscribers' table, and max 255 chars.
        $request->validate([
            'email' => 'required|email|unique:subscribers,email|max:255',
        ]);

        try {
            // 2. Create a new Subscriber record
            Subscriber::create([
                'email' => $request->email,
            ]);

            // Optional: Log the successful subscription
            Log::info('New subscriber: ' . $request->email);

            // 3. Redirect back to the previous page (the blog page) with a success message
            // 'subscribe_success' is a session flash key that your Blade view checks for.
            return back()->with('subscribe_success', 'Thank you for subscribing to our newsletter!');

        } catch (\Exception $e) {
            // Optional: Log any errors that occur during saving
            Log::error('Error subscribing email: ' . $e->getMessage(), ['email' => $request->email]);

            // Redirect back with an error message in case something goes wrong
            return back()->withErrors(['email' => 'Could not subscribe your email. Please try again.'])->withInput();
        }
    }
}
