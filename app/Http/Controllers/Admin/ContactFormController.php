<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToContactMail;
use Illuminate\Support\Facades\Log;

class ContactFormController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        //Security logging
        Log::info('Admin viewed contact message list', [
            'event' => 'admin_contact_index',
            'admin_id' => auth()->id(),
            'total_items' => $messages->total(),
            'per_page' => $messages->perPage(),
            'current_page' => $messages->currentPage(),
        ]);

        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        //Security logging
        Log::info('Admin viewed contact message', [
            'event' => 'admin_contact_show',
            'admin_id' => auth()->id(),
            'message_id' => $message->id,
            'user_id' => $message->user_id,
            'email' => $message->email,
        ]);

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

        //Security logging
        Log::notice('Admin replied to contact message', [
            'event' => 'admin_contact_reply',
            'admin_id' => auth()->id(),
            'message_id' => $message->id,
            'user_id' => $message->user_id,
            'email' => $message->email,
        ]);

        return redirect()->route('admin.contact.index')->with('success', 'Antwoord verzonden.');
    }
}
