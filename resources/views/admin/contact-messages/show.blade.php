@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-envelope mr-3"></i>
    {{ __('Contact Message Details') }}
</h2>
<p class="text-indigo-100 mt-2">View contact form submission details</p>
@endsection

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endpush

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.contact-messages.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to Messages
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <h3 class="text-white text-xl font-bold">Contact Message Details</h3>
            </div>

            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-900">{{ $contactMessage->full_name }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-900">
                        <a href="mailto:{{ $contactMessage->email }}" class="text-indigo-600 hover:text-indigo-800">
                            {{ $contactMessage->email }}
                            <i class="fas fa-envelope ml-2"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-900">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->whatsapp_number) }}" 
                           target="_blank" 
                           class="text-indigo-600 hover:text-indigo-800">
                            {{ $contactMessage->whatsapp_number }}
                            <i class="fab fa-whatsapp ml-2"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-900 whitespace-pre-wrap">{{ $contactMessage->message }}</div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Submitted At</label>
                        <div class="bg-gray-50 rounded-lg p-4 text-gray-900">{{ $contactMessage->created_at->format('F d, Y \a\t h:i A') }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($contactMessage->is_read)
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Read</span>
                            @else
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Unread</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                <form action="{{ route('admin.contact-messages.mark-as-read', $contactMessage) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-check mr-2"></i> Mark as Read
                    </button>
                </form>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

