@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-box mr-3"></i>
    {{ __('My Products') }}
</h2>
<p class="text-indigo-100 mt-2">Manage your products and services</p>
@endsection

@section('content')
<style>
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
    }
    
    .product-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    .featured-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Actions -->
        <div class="mb-8 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    My <span class="gradient-text">Products</span>
                </h1>
                <p class="text-gray-600 text-lg">Manage and showcase your products and services</p>
            </div>
            <a href="{{ route('products.create') }}"
               class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add New Product
            </a>
        </div>

        @if($products->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                        @if($product->featured)
                            <div class="featured-badge">
                                <i class="fas fa-star mr-1"></i> Featured
                            </div>
                        @endif
                        
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gradient-to-br from-indigo-100 to-purple-100 overflow-hidden">
                            @if($product->image && Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="product-image">
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
                            
                            @if($product->price)
                                <div class="mb-4">
                                    <span class="text-2xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                                </div>
                            @endif
                            
                            <!-- Actions -->
                            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="flex-1 bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-100 transition text-center">
                                    <i class="fas fa-eye mr-2"></i> View
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="flex-1 bg-purple-50 text-purple-600 px-4 py-2 rounded-lg font-medium hover:bg-purple-100 transition text-center">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-100 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-box text-indigo-600 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Products Yet</h3>
                <p class="text-gray-600 mb-6">Start showcasing your products and services by adding your first product.</p>
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    Add Your First Product
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

