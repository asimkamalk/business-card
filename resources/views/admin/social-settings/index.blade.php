@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-share-alt mr-3"></i>
    {{ __('Social Settings') }}
</h2>
<p class="text-indigo-100 mt-2">Manage social media links and contact information for the landing page</p>
@endsection

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body {
        font-family: "Inter", sans-serif;
    }
    .settings-wrapper {
        background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
        margin-left: -1.5rem;
        margin-right: -1.5rem;
        margin-top: -3rem;
        margin-bottom: -3rem;
        min-height: calc(100vh - 200px);
        padding: 2rem 1rem;
    }
    @media (min-width: 768px) {
        .settings-wrapper {
            padding: 2rem 1.5rem;
        }
    }
    @media (min-width: 1024px) {
        .settings-wrapper {
            padding: 2rem 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="settings-wrapper">
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.social-settings.update') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            @csrf
            @method('PUT')

            <!-- Bio Section -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-align-left text-indigo-600 mr-2"></i>
                    Bio / Text (Center of Landing Page)
                </h3>
                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                        Bio Text
                    </label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="Enter bio text that will appear in the center of the landing page..."
                    >{{ old('bio', $setting->bio ?? '') }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-phone text-indigo-600 mr-2"></i>
                    Contact Information (Above Navbar)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input 
                            type="text" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone', $setting->phone ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="+971 50 123 4567"
                        >
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                            WhatsApp Number/Link
                        </label>
                        <input 
                            type="text" 
                            id="whatsapp" 
                            name="whatsapp" 
                            value="{{ old('whatsapp', $setting->whatsapp ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="+971 50 123 4567 or https://wa.me/971501234567"
                        >
                        @error('whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Will appear as floating button on bottom right</p>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-indigo-600 mr-2"></i>Email Address
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $setting->email ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="info@itappdigital.com"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Will appear on the right side of the header</p>
                    </div>
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-share-alt text-indigo-600 mr-2"></i>
                    Social Media Links (Above Navbar)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook URL
                        </label>
                        <input 
                            type="url" 
                            id="facebook" 
                            name="facebook" 
                            value="{{ old('facebook', $setting->facebook ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="https://facebook.com/yourpage"
                        >
                        @error('facebook')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram URL
                        </label>
                        <input 
                            type="url" 
                            id="instagram" 
                            name="instagram" 
                            value="{{ old('instagram', $setting->instagram ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="https://instagram.com/yourpage"
                        >
                        @error('instagram')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter URL
                        </label>
                        <input 
                            type="url" 
                            id="twitter" 
                            name="twitter" 
                            value="{{ old('twitter', $setting->twitter ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="https://twitter.com/yourpage"
                        >
                        @error('twitter')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-linkedin text-blue-700 mr-2"></i>LinkedIn URL
                        </label>
                        <input 
                            type="url" 
                            id="linkedin" 
                            name="linkedin" 
                            value="{{ old('linkedin', $setting->linkedin ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="https://linkedin.com/company/yourpage"
                        >
                        @error('linkedin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="youtube" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube URL
                        </label>
                        <input 
                            type="url" 
                            id="youtube" 
                            name="youtube" 
                            value="{{ old('youtube', $setting->youtube ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="https://youtube.com/channel/yourchannel"
                        >
                        @error('youtube')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tiktok" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-tiktok text-black mr-2"></i>TikTok URL
                        </label>
                        <input 
                            type="url" 
                            id="tiktok" 
                            name="tiktok" 
                            value="{{ old('tiktok', $setting->tiktok ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="https://tiktok.com/@yourpage"
                        >
                        @error('tiktok')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Active Status -->
            <div class="mb-8">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="is_active" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', $setting->is_active ?? true) ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                    >
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Show social settings on landing page
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 flex items-center"
                >
                    <i class="fas fa-save mr-2"></i>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

