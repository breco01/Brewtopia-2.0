<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToContactMail;

class ContactFormController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        return view('admin.contact.show', compact('message'));
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply_message' => 'required|string|min:5'
        ]);

        $message->update([
            'reply_message' => $request->reply_message,
            'replied_at' => now(),
            'replied_by' => auth()->id(),
            'status' => 'replied',
            'is_read' => false,
        ]);

        //Mail::to($message->email)->send(new ReplyToContactMail($message));

        return redirect()->route('admin.contact.index')->with('success', 'Antwoord verzonden.');
    }
}
