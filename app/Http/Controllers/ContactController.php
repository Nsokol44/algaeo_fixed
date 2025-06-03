<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // If you plan to send emails
use App\Mail\ContactFormMail; // If you create a Mailable

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            // Add any other fields from your form
        ]);

        
        Mail::to('algaeo@algaeo.io')->send(new ContactFormMail($validatedData));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
        // Or log it:
        \Log::info('Contact form submission:', $validatedData);

        
        // 3. Instead of redirecting, return the view with a 'submitted' flag
        return view('contact')->with('submitted', true);
        // 3. Redirect back with a success message
        //return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}