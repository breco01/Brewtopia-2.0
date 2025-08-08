<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactMessageMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        $message = ContactMessage::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Stuur mail naar admin
        Mail::to(config('mail.admin_address'))->send(new NewContactMessageMail($message));

        return redirect()->route('contact.create')->with('success', 'Bedankt voor je bericht! We nemen spoedig contact met je op.');
    }
}
