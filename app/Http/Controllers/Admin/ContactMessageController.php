<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('whatsapp_number', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by read/unread
        if ($request->has('filter') && $request->filter !== 'all') {
            $query->where('is_read', $request->filter === 'read');
        }

        $messages = $query->latest()->paginate(15);
        $messages->appends(['search' => $request->search, 'filter' => $request->filter]);

        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::where('is_read', false)->count(),
            'read' => ContactMessage::where('is_read', true)->count(),
        ];

        return view('admin.contact-messages.index', compact('messages', 'stats'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Contact message deleted successfully!');
    }
}
