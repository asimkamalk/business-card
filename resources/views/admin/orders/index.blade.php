@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-shopping-cart mr-3"></i>
    {{ __('Orders Management') }}
</h2>
<p class="text-indigo-100 mt-2">View and manage all product orders</p>
@endsection

@section('content')
<style>
    .dashboard-wrapper {
        background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
        margin-left: -1.5rem;
        margin-right: -1.5rem;
        margin-top: -3rem;
        margin-bottom: -3rem;
        min-height: calc(100vh - 200px);
        padding: 2rem 1rem;
    }
    @media (min-width: 768px) {
        .dashboard-wrapper {
            padding: 2rem 1.5rem;
        }
    }
    @media (min-width: 1024px) {
        .dashboard-wrapper {
            padding: 2rem 2rem;
        }
    }
    .tab-button {
        transition: all 0.3s ease;
    }
    .tab-button.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
</style>

<div class="dashboard-wrapper">
    <main style="max-width: 1280px; margin: 0 auto;">
        <!-- Tabs Navigation -->
        <div class="bg-white rounded-2xl shadow-lg mb-6 p-2">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="tab-button px-6 py-3 rounded-xl font-semibold {{ request()->routeIs('admin.dashboard') ? 'active' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.admin-products.index') }}" 
                   class="tab-button px-6 py-3 rounded-xl font-semibold {{ request()->routeIs('admin.admin-products.*') ? 'active' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-box mr-2"></i> Products (NFC Cards)
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="tab-button px-6 py-3 rounded-xl font-semibold {{ request()->routeIs('admin.orders.*') ? 'active' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-shopping-cart mr-2"></i> Orders
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="tab-button px-6 py-3 rounded-xl font-semibold {{ request()->routeIs('admin.users.*') ? 'active' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-users mr-2"></i> Users
                </a>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                <h3 class="font-heading font-bold text-xl flex items-center">
                    <i class="fas fa-shopping-cart mr-2"></i>All Orders
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $order->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                                <div class="text-xs text-gray-400">{{ $order->customer_whatsapp }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $order->adminProduct->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">AED {{ number_format($order->total_amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                                    {{ str_replace('_', ' ', $order->payment_method) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'processing' => 'bg-purple-100 text-purple-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }} capitalize">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.orders.show', $order->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this order?');">
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
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection

