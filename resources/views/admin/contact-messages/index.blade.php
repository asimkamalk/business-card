@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-envelope mr-3"></i>
    {{ __('Contact Messages') }}
</h2>
<p class="text-indigo-100 mt-2">View and manage contact form submissions</p>
@endsection

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body {
        font-family: "Inter", sans-serif;
    }
    .messages-wrapper {
        background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
        margin-left: -1.5rem;
        margin-right: -1.5rem;
        margin-top: -3rem;
        margin-bottom: -3rem;
        min-height: calc(100vh - 200px);
        padding: 2rem 1rem;
    }
    @media (min-width: 768px) {
        .messages-wrapper {
            padding: 2rem 1.5rem;
        }
    }
    @media (min-width: 1024px) {
        .messages-wrapper {
            padding: 2rem 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="messages-wrapper">
    <div class="max-w-7xl mx-auto">
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Messages</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="bg-indigo-100 rounded-full p-4">
                        <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Unread</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $stats['unread'] }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-4">
                        <i class="fas fa-envelope-open text-yellow-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Read</p>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['read'] }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-4">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search by name, email, WhatsApp, or message..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
                <div>
                    <select name="filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="all" {{ request('filter') === 'all' ? 'selected' : '' }}>All Messages</option>
                        <option value="unread" {{ request('filter') === 'unread' ? 'selected' : '' }}>Unread</option>
                        <option value="read" {{ request('filter') === 'read' ? 'selected' : '' }}>Read</option>
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </form>
        </div>

        <!-- Messages Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">WhatsApp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($messages as $message)
                        <tr class="{{ !$message->is_read ? 'bg-yellow-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $message->full_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <a href="mailto:{{ $message->email }}" class="text-indigo-600 hover:text-indigo-800">
                                        {{ $message->email }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $message->whatsapp_number }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 line-clamp-2">{{ Str::limit($message->message, 100) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $message->created_at->format('M d, Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($message->is_read)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Read</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Unread</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No contact messages found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

