@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-plus-circle mr-3"></i>
    {{ __('Add New Product') }}
</h2>
<p class="text-indigo-100 mt-2">Create a new product or service</p>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Product Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Price -->
                <div class="mb-6">
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Price
                    </label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           step="0.01"
                           min="0"
                           value="{{ old('price') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        Product Image
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    <p class="mt-2 text-sm text-gray-500">Recommended size: 600x400px. Max file size: 2MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div id="image-preview" class="mt-4 hidden">
                        <img id="preview-img" src="" alt="Preview" class="max-w-full h-64 object-cover rounded-xl border border-gray-300">
                    </div>
                </div>
                
                <!-- Featured -->
                <div class="mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" 
                               name="featured" 
                               value="1"
                               {{ old('featured') ? 'checked' : '' }}
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-3 text-sm font-semibold text-gray-700">
                            Mark as Featured Product
                        </span>
                    </label>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Create Product
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image preview
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

