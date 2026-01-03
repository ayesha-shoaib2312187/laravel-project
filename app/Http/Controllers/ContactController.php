<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = \App\Models\ContactInfo::first();
        // Optional: Ensure it's not null if you want to avoid errors in view,
        // or handle null in blade. Let's send what we have.
        return view('contact', compact('contactInfo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create(array_merge($request->all(), ['date' => now()]));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
