<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('date', 'desc')->paginate(10);
        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.show', ['message' => $contactMessage]);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted successfully!');
    }

    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        // In a real application, you would send an email here.
        // For example:
        // Mail::to($contactMessage->email)->send(new ContactMessageReply($request->reply));

        $contactMessage->update([
            'reply' => $request->reply,
            'replied_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }
}
