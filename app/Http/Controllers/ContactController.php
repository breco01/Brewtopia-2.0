<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactMessageMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        $message = ContactMessage::create([
            'user_id' => $user?->id,
            'name' => $user?->name ?? ($data['name'] ?? null),
            'email' => $user?->email ?? ($data['email'] ?? null),
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Stuur mail naar admin
        //Mail::to(config('mail.admin_address'))->send(new NewContactMessageMail($message));

        //Security logging
        Log::info('Contact message submitted', [
            'event' => 'contact_message_created',
            'user_id' => $user?->id,
            'email' => $message->email,
            'subject' => $message->subject,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('contact.overzicht')->with('success', 'Bericht verzonden.');
    }

    public function overzicht()
    {
        $user = auth()->user();

        $messages = ContactMessage::query()
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('email', $user->email); // fallback voor oude/guest records
            })
            ->orderByDesc('created_at')
            ->get();

        // markeer eventuele nieuwe replies gelezen
        ContactMessage::where(function ($q) use ($user) {
            $q->where('user_id', $user->id)
                ->orWhere('email', $user->email);
        })
            ->whereNotNull('reply_message')
            ->update(['is_read' => true]);

        return view('contact.overview', compact('messages'));
    }


}
