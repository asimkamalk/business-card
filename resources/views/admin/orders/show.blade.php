@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-shopping-cart mr-3"></i>
    {{ __('Order Details') }}
</h2>
<p class="text-indigo-100 mt-2">View order information</p>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}"
               class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back to Orders
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Order Information</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Order ID</p>
                    <p class="text-lg font-semibold text-gray-900">#{{ $order->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Status</p>
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline">
                        @csrf
                        <select name="status" onchange="this.form.submit()" 
                                class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Product</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->adminProduct->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Amount</p>
                    <p class="text-2xl font-bold text-indigo-600">AED {{ number_format($order->total_amount, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Payment Method</p>
                    <p class="text-lg font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Order Date</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Customer Information</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Full Name</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Email</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">WhatsApp</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->customer_whatsapp }}</p>
                </div>
                @if($order->customer_phone)
                <div>
                    <p class="text-sm text-gray-500 mb-1">Phone</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->customer_phone }}</p>
                </div>
                @endif
                @if($order->customer_address)
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500 mb-1">Address</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->customer_address }}</p>
                </div>
                @endif
                @if($order->notes)
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500 mb-1">Notes</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

