<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Notifications\ContactMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp_number' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $contactMessage = ContactMessage::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'message' => $request->message,
        ]);

        // Send email notification to info@itappdigital.com
        try {
            Mail::to('info@itappdigital.com')->send(new \App\Mail\ContactMessageMail($contactMessage));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send contact email: ' . $e->getMessage());
        }

        return back()->with('contact_success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
