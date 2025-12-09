@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-plus-circle mr-3"></i>
    {{ __('Add New Product (NFC Card)') }}
</h2>
<p class="text-indigo-100 mt-2">Create a new product for the home page</p>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.admin-products.index') }}"
               class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back to Products
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('admin.admin-products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Price <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    <p class="mt-2 text-sm text-gray-500">Recommended size: 600x400px. Max file size: 2MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div id="image-preview" class="mt-4 hidden">
                        <img id="preview-img" src="" alt="Preview" class="max-w-full h-64 object-cover rounded-xl border border-gray-300">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="features" class="block text-sm font-semibold text-gray-700 mb-2">Features</label>
                    <textarea name="features" id="features" rows="4" placeholder="Enter product features, one per line..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">{{ old('features') }}</textarea>
                    @error('features')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="stock_quantity" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity (Optional)</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" min="0" value="{{ old('stock_quantity') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    @error('stock_quantity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6 space-y-3">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-3 text-sm font-semibold text-gray-700">Mark as Featured (appears on home page)</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-3 text-sm font-semibold text-gray-700">Active (available for purchase)</span>
                    </label>
                </div>
                
                <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Create Product
                    </button>
                    <a href="{{ route('admin.admin-products.index') }}"
                       class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

