@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-chart-line mr-3"></i>
    {{ __('Admin Dashboard') }}
</h2>
<p class="text-indigo-100 mt-2">Overview of your platform statistics</p>
@endsection

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body {
        font-family: "Inter", sans-serif;
    }
</style>
@endpush

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
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    @media (min-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    .tables-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 1024px) {
        .tables-grid {
            grid-template-columns: repeat(2, 1fr);
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
    <!-- Main Content -->
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
        
        <!-- Stats Cards -->
        <div class="stats-grid">
            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-indigo-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white shadow-lg mr-4">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Users</p>
                            <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_users']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Profiles -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white shadow-lg mr-4">
                            <i class="fas fa-id-card text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Business Cards</p>
                            <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_profiles']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-lg mr-4">
                            <i class="fas fa-boxes text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Products</p>
                            <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_products']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white shadow-lg mr-4">
                            <i class="fas fa-cube text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Categories</p>
                            <p class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_categories']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="tables-grid">
            <!-- Recent Users -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <h3 class="font-heading font-bold text-xl flex items-center">
                        <i class="fas fa-users mr-2"></i>Recent Users
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentUsers as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-600 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->is_admin)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Admin</span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">User</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No users found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Products -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    <h3 class="font-heading font-bold text-xl flex items-center">
                        <i class="fas fa-boxes mr-2"></i>Recent Products
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentProducts as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-lg overflow-hidden mr-3">
                                            @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" />
                                            @else
                                            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        N/A
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($product->price)
                                    AED {{ number_format($product->price, 2) }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->profile && $product->profile->user ? $product->profile->user->name : 'N/A' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No products found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
