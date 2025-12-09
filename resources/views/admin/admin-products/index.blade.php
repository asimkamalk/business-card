@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-box mr-3"></i>
    {{ __('Manage Products (NFC Cards)') }}
</h2>
<p class="text-indigo-100 mt-2">Add and manage NFC cards for sale on the home page</p>
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
    .product-card {
        transition: all 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
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

        <!-- Header Actions -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">NFC Cards Management</h1>
                    <p class="text-gray-600">Manage products that appear on the home page</p>
                </div>
                <a href="{{ route('admin.admin-products.create') }}"
                   class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Product
                </a>
            </div>
        </div>

        @if($products->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                        @if($product->featured)
                            <div class="absolute top-4 right-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg z-10">
                                <i class="fas fa-star mr-1"></i> Featured
                            </div>
                        @endif
                        
                        @if(!$product->is_active)
                            <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg z-10">
                                Inactive
                            </div>
                        @endif
                        
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gradient-to-br from-indigo-100 to-purple-100 overflow-hidden">
                            @if($product->image && Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-indigo-300 text-5xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                            
                            @if($product->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                            @endif
                            
                            <div class="mb-4">
                                <span class="text-2xl font-bold text-indigo-600">AED {{ number_format($product->price, 2) }}</span>
                                @if($product->stock_quantity !== null)
                                    <span class="text-sm text-gray-500 ml-2">({{ $product->stock_quantity }} in stock)</span>
                                @endif
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                <a href="{{ route('orders.create', $product->id) }}" 
                                   target="_blank"
                                   class="flex-1 bg-indigo-50 text-indigo-600 px-3 py-2 rounded-lg font-medium hover:bg-indigo-100 transition text-center text-sm">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <a href="{{ route('admin.admin-products.edit', $product->id) }}"
                                   class="flex-1 bg-purple-50 text-purple-600 px-3 py-2 rounded-lg font-medium hover:bg-purple-100 transition text-center text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.admin-products.destroy', $product->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-50 text-red-600 px-3 py-2 rounded-lg font-medium hover:bg-red-100 transition text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="bg-white rounded-2xl shadow-lg p-4">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-box text-indigo-600 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Products Yet</h3>
                <p class="text-gray-600 mb-6">Start by adding NFC cards that will appear on the home page.</p>
                <a href="{{ route('admin.admin-products.create') }}"
                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    Add Your First Product
                </a>
            </div>
        @endif
    </main>
</div>
@endsection

