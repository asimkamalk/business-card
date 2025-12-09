@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-edit mr-3"></i>
    {{ __('Edit Profile') }}
</h2>
<p class="text-indigo-100 mt-2">Customize your digital business card</p>
@endsection

@section('content')
<style>
    #banner-preview img,
    #product-preview-0 img,
    #product-preview-1 img,
    #product-preview-2 img,
    #product-preview-3 img,
    [id^="product-preview-"] img {
        max-width: 100% !important;
        max-height: 100% !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
    }
    #banner-preview,
    [id^="product-preview-"] {
        max-width: 100% !important;
        overflow: hidden !important;
    }
    
    /* Enhanced Form Styling */
    .form-section {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }
    
    .form-section:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .form-input {
        transition: all 0.2s ease;
        border: 2px solid #e5e7eb;
    }
    
    .form-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    
    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }
    
    .file-input-label {
        display: block;
        padding: 0.75rem 1rem;
        background: #f9fafb;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .file-input-label:hover {
        background: #f3f4f6;
        border-color: #667eea;
        color: #667eea;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(102, 126, 234, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.4);
    }
    
    .btn-add {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        transition: all 0.3s ease;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.4);
    }
    
    .item-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.25rem;
        transition: all 0.3s ease;
    }
    
    .item-card:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .product-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        border-color: #667eea;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .image-preview-container {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        overflow: hidden;
        background: #f9fafb;
        transition: all 0.3s ease;
    }
    
    .image-preview-container:hover {
        border-color: #667eea;
        background: #f3f4f6;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Business Card Editor
                </span>
            </h1>
            <p class="text-gray-600 text-lg">Create and customize your professional digital business card</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Profile URL Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-link text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Profile URL</h2>
                        <p class="text-sm text-gray-500 mt-1">Your unique shareable link</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-globe mr-2 text-indigo-600"></i>Your Business Card URL
                    </label>
                    <div class="flex items-center bg-gray-50 rounded-xl p-1 border-2 border-gray-200 focus-within:border-indigo-500 transition">
                        <div class="bg-white text-gray-600 px-4 py-3 rounded-l-lg border-r border-gray-200 font-medium text-sm">
                            {{ config('app.url') }}/
                        </div>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            class="flex-1 px-4 py-3 bg-transparent border-0 focus:ring-0 text-gray-900 font-medium"
                            placeholder="your-username">
                    </div>
                    <p class="text-xs text-gray-500 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Can only contain letters, numbers, and hyphens
                    </p>
                </div>
            </div>

            <!-- Theme Selection -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-palette text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Theme Selection</h2>
                        <p class="text-sm text-gray-500 mt-1">Choose a theme for your public profile</p>
                    </div>
                </div>
                
                @php
                    $themes = [
                        'modern' => [
                            'name' => 'Modern', 
                            'colors' => ['from-indigo-600', 'via-purple-600', 'to-pink-500'], 
                            'icon' => 'fa-sparkles',
                            'banner' => 'bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500',
                            'button' => 'bg-gradient-to-r from-indigo-600 to-purple-600',
                            'text' => 'text-indigo-700',
                            'iconBg' => 'bg-gradient-to-br from-indigo-100 to-purple-100',
                            'description' => 'Vibrant indigo to purple gradient with modern aesthetics'
                        ],
                        'classic' => [
                            'name' => 'Classic', 
                            'colors' => ['from-blue-600', 'via-cyan-600', 'to-teal-500'], 
                            'icon' => 'fa-book',
                            'banner' => 'bg-gradient-to-br from-blue-600 via-cyan-600 to-teal-500',
                            'button' => 'bg-gradient-to-r from-blue-600 to-cyan-600',
                            'text' => 'text-blue-700',
                            'iconBg' => 'bg-gradient-to-br from-blue-100 to-cyan-100',
                            'description' => 'Elegant blue to cyan gradient with professional look'
                        ],
                        'minimal' => [
                            'name' => 'Minimal', 
                            'colors' => ['from-slate-600', 'via-gray-600', 'to-zinc-700'], 
                            'icon' => 'fa-circle',
                            'banner' => 'bg-gradient-to-br from-slate-600 via-gray-600 to-zinc-700',
                            'button' => 'bg-gradient-to-r from-slate-700 to-gray-800',
                            'text' => 'text-slate-700',
                            'iconBg' => 'bg-gradient-to-br from-slate-100 to-gray-100',
                            'description' => 'Clean and sophisticated with subtle gray tones'
                        ],
                        'dark' => [
                            'name' => 'Dark', 
                            'colors' => ['from-slate-900', 'via-gray-900', 'to-black'], 
                            'icon' => 'fa-moon',
                            'banner' => 'bg-gradient-to-br from-slate-900 via-gray-900 to-black',
                            'button' => 'bg-gradient-to-r from-slate-700 to-gray-800',
                            'text' => 'text-slate-200',
                            'iconBg' => 'bg-gradient-to-br from-slate-700 to-gray-800',
                            'description' => 'Sleek dark theme with excellent contrast'
                        ],
                        'colorful' => [
                            'name' => 'Colorful', 
                            'colors' => ['from-pink-500', 'via-purple-500', 'via-indigo-500', 'to-cyan-500'], 
                            'icon' => 'fa-rainbow',
                            'banner' => 'bg-gradient-to-br from-pink-500 via-purple-500 via-indigo-500 to-cyan-500',
                            'button' => 'bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-600',
                            'text' => 'text-pink-700',
                            'iconBg' => 'bg-gradient-to-br from-pink-100 via-purple-100 to-indigo-100',
                            'description' => 'Vibrant rainbow gradient with energetic colors'
                        ]
                    ];
                    // Ensure theme exists, default to 'modern' if not set
                    $currentTheme = old('theme', $profile->theme ?? 'modern');
                    if (!in_array($currentTheme, array_keys($themes))) {
                        $currentTheme = 'modern';
                    }
                    $selectedThemeData = $themes[$currentTheme] ?? $themes['modern'];
                @endphp
                
                <!-- Theme Dropdown -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-palette mr-2 text-indigo-600"></i>Select Theme
                    </label>
                    <div class="relative">
                        <select name="theme" id="theme-select" class="w-full px-4 py-3 pr-10 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none appearance-none bg-white cursor-pointer form-input">
                            @foreach($themes as $themeKey => $themeData)
                                <option value="{{ $themeKey }}" {{ $currentTheme == $themeKey ? 'selected' : '' }}>{{ $themeData['name'] }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-indigo-600"></i>
                        <span>Your selected theme will be applied to your public profile when you save.</span>
                    </p>
                </div>
            </div>

            <!-- Images Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-images text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Images</h2>
                        <p class="text-sm text-gray-500 mt-1">Upload your banner and profile images</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Banner Image -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-image mr-2 text-indigo-600"></i>Banner Image
                        </label>
                        <div class="image-preview-container h-20 mb-3" id="banner-preview">
                            @php
                                $bannerPath = $profile->banner_image ?? 'banners/default-banner.jpg';
                                $hasBanner = $profile->banner_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->banner_image) && !\Illuminate\Support\Str::contains($profile->banner_image, 'default-banner');
                            @endphp
                            @if($hasBanner)
                                <img src="{{ asset('storage/' . $profile->banner_image) }}"
                                    id="banner-image"
                                    class="w-full h-full object-cover"
                                    style="max-width: 100% !important; max-height: 100% !important; width: 100% !important; height: 100% !important; object-fit: cover !important;"
                                    alt="Banner">
                            @else
                                <div id="banner-placeholder" class="w-full h-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-2xl opacity-50"></i>
                                </div>
                            @endif
                        </div>
                        <div class="file-input-wrapper">
                            <label for="banner-input" class="file-input-label">
                                <i class="fas fa-upload mr-2"></i>Choose Banner Image
                            </label>
                            <input type="file" name="banner_image" id="banner-input" accept="image/*">
                        </div>
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Recommended: 1200x400 pixels, JPG/PNG
                        </p>
                    </div>

                    <!-- Profile Image -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-user-circle mr-2 text-indigo-600"></i>Profile Image
                        </label>
                        <div class="flex items-start gap-4">
                            <div class="image-preview-container w-32 h-32 rounded-full overflow-hidden flex-shrink-0" id="profile-preview">
                                @php
                                    $profilePath = $profile->profile_image ?? 'profiles/default-avatar.jpg';
                                    $hasProfile = $profile->profile_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->profile_image) && !\Illuminate\Support\Str::contains($profile->profile_image, 'default-avatar');
                                @endphp
                                @if($hasProfile)
                                    <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                        id="profile-image"
                                        class="w-full h-full object-cover"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                        alt="Profile">
                                @else
                                    <div id="profile-placeholder" class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="file-input-wrapper">
                                    <label for="profile-input" class="file-input-label">
                                        <i class="fas fa-upload mr-2"></i>Choose Profile Image
                                    </label>
                                    <input type="file" name="profile_image" id="profile-input" accept="image/*">
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Recommended: 400x400 pixels, JPG/PNG
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-user text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Basic Information</h2>
                        <p class="text-sm text-gray-500 mt-1">Tell people about yourself</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-building mr-2 text-indigo-600"></i>Company
                        </label>
                        <input type="text" name="company" value="{{ old('company', $profile->company) }}"
                            class="form-input w-full px-4 py-3 rounded-lg"
                            placeholder="Your company name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-briefcase mr-2 text-indigo-600"></i>Position
                        </label>
                        <input type="text" name="position" value="{{ old('position', $profile->position) }}"
                            class="form-input w-full px-4 py-3 rounded-lg"
                            placeholder="Your job title">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>Location
                        </label>
                        <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                            class="form-input w-full px-4 py-3 rounded-lg"
                            placeholder="City, Country" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-indigo-600"></i>Bio
                        </label>
                        <textarea name="bio" rows="4"
                            class="form-input w-full px-4 py-3 rounded-lg resize-none"
                            placeholder="Write a short description about yourself or your company...">{{ old('bio', $profile->bio) }}</textarea>
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Short description about yourself or company
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-address-book text-lg"></i>
                    </div>
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Contact Information</h2>
                            <p class="text-sm text-gray-500 mt-1">Add your contact details</p>
                        </div>
                        <button type="button" id="add-contact"
                            class="btn-add text-white px-5 py-2.5 rounded-lg font-medium flex items-center shadow-lg">
                            <i class="fas fa-plus mr-2"></i> Add Contact
                        </button>
                    </div>
                </div>
                <div id="contact-section" class="space-y-4">
                    @foreach($contacts as $index => $contact)
                    <div class="item-card fade-in">
                        <div class="flex flex-col md:flex-row gap-3">
                            <div class="flex-1">
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Contact Type</label>
                                <select name="contacts[{{ $index }}][type]" class="form-input w-full px-4 py-2.5 rounded-lg">
                                    <option value="mobile" {{ $contact->type == 'mobile' ? 'selected' : '' }}>📱 Mobile</option>
                                    <option value="whatsapp" {{ $contact->type == 'whatsapp' ? 'selected' : '' }}>💬 WhatsApp</option>
                                    <option value="email" {{ $contact->type == 'email' ? 'selected' : '' }}>✉️ Email</option>
                                    <option value="website" {{ $contact->type == 'website' ? 'selected' : '' }}>🌐 Website</option>
                                    <option value="telegram" {{ $contact->type == 'telegram' ? 'selected' : '' }}>✈️ Telegram</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Contact Value</label>
                                <input type="text" name="contacts[{{ $index }}][value]"
                                    value="{{ $contact->value }}"
                                    class="form-input w-full px-4 py-2.5 rounded-lg"
                                    placeholder="Enter contact information">
                            </div>
                            <div class="flex items-end">
                                <button type="button" class="btn-danger text-white px-4 py-2.5 rounded-lg font-medium transition"
                                    onclick="this.closest('.item-card').remove()">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Social Media -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-share-alt text-lg"></i>
                    </div>
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Social Media Links</h2>
                            <p class="text-sm text-gray-500 mt-1">Connect your social profiles</p>
                        </div>
                        <button type="button" id="add-social"
                            class="btn-add text-white px-5 py-2.5 rounded-lg font-medium flex items-center shadow-lg">
                            <i class="fas fa-plus mr-2"></i> Add Social
                        </button>
                    </div>
                </div>
                <div id="social-section" class="space-y-4">
                    @foreach($socials as $index => $social)
                    <div class="item-card fade-in">
                        <div class="flex flex-col md:flex-row gap-3">
                            <div class="flex-1">
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Platform</label>
                                <select name="socials[{{ $index }}][platform]" class="form-input w-full px-4 py-2.5 rounded-lg">
                                    <option value="instagram" {{ $social->platform == 'instagram' ? 'selected' : '' }}>📷 Instagram</option>
                                    <option value="facebook" {{ $social->platform == 'facebook' ? 'selected' : '' }}>👥 Facebook</option>
                                    <option value="twitter" {{ $social->platform == 'twitter' ? 'selected' : '' }}>🐦 Twitter</option>
                                    <option value="linkedin" {{ $social->platform == 'linkedin' ? 'selected' : '' }}>💼 LinkedIn</option>
                                    <option value="youtube" {{ $social->platform == 'youtube' ? 'selected' : '' }}>📺 YouTube</option>
                                    <option value="tiktok" {{ $social->platform == 'tiktok' ? 'selected' : '' }}>🎵 TikTok</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">URL</label>
                                <input type="text" name="socials[{{ $index }}][url]"
                                    value="{{ $social->url }}"
                                    class="form-input w-full px-4 py-2.5 rounded-lg"
                                    placeholder="https://...">
                            </div>
                            <div class="flex items-end">
                                <button type="button" class="btn-danger text-white px-4 py-2.5 rounded-lg font-medium transition"
                                    onclick="this.closest('.item-card').remove()">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Products Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-box text-lg"></i>
                    </div>
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Featured Products</h2>
                            <p class="text-sm text-gray-500 mt-1">Showcase your products or services</p>
                        </div>
                        <button type="button" id="add-product"
                            class="btn-add text-white px-5 py-2.5 rounded-lg font-medium flex items-center shadow-lg">
                            <i class="fas fa-plus mr-2"></i> Add Product
                        </button>
                    </div>
                </div>
                <div id="product-section" class="space-y-5">
                    @foreach($products as $index => $product)
                    <div class="product-card fade-in">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-indigo-600"></i>Product Name
                                </label>
                                <input type="text" name="products[{{ $index }}][name]"
                                    value="{{ $product->name }}"
                                    class="form-input w-full px-4 py-3 rounded-lg"
                                    placeholder="Product name">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-dollar-sign mr-2 text-indigo-600"></i>Price (AED)
                                </label>
                                <input type="number" name="products[{{ $index }}][price]"
                                    value="{{ $product->price }}"
                                    class="form-input w-full px-4 py-3 rounded-lg"
                                    placeholder="0.00" step="0.01" min="0">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-indigo-600"></i>Description
                                </label>
                                <textarea name="products[{{ $index }}][description]" rows="3"
                                    class="form-input w-full px-4 py-3 rounded-lg resize-none"
                                    placeholder="Describe your product...">{{ $product->description }}</textarea>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="products[{{ $index }}][featured]"
                                    id="featured-{{ $index }}"
                                    class="h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300"
                                    {{ $product->featured ? 'checked' : '' }}>
                                <label for="featured-{{ $index }}" class="ml-3 text-sm font-medium text-gray-700">
                                    <i class="fas fa-star mr-1 text-yellow-500"></i>Featured Product
                                </label>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-image mr-2 text-indigo-600"></i>Product Image
                                </label>
                                <div class="image-preview-container h-20 mb-3" id="product-preview-{{ $index }}">
                                    @php
                                        $hasProductImage = $product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image) && !\Illuminate\Support\Str::contains($product->image, 'default-property');
                                    @endphp
                                    @if($hasProductImage)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            id="product-image-{{ $index }}"
                                            class="w-full h-full object-cover"
                                            style="max-width: 100% !important; max-height: 100% !important; width: 100% !important; height: 100% !important; object-fit: cover !important;"
                                            alt="Product">
                                    @else
                                        <div id="product-placeholder-{{ $index }}" class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="file-input-wrapper">
                                    <label for="product-input-{{ $index }}" class="file-input-label">
                                        <i class="fas fa-upload mr-2"></i>Choose Product Image
                                    </label>
                                    <input type="file" name="products[{{ $index }}][image]" 
                                        id="product-input-{{ $index }}"
                                        accept="image/*">
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Recommended: 600x400 pixels, JPG/PNG
                                </p>
                            </div>
                        </div>
                        <button type="button" class="mt-4 btn-danger text-white px-4 py-2.5 rounded-lg font-medium transition"
                            onclick="this.closest('.product-card').remove()">
                            <i class="fas fa-trash mr-2"></i> Remove Product
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Save Button -->
            <div class="form-section bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                <div class="text-center">
                    <button type="submit"
                        class="bg-white text-indigo-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-2xl flex items-center justify-center mx-auto">
                        <i class="fas fa-save mr-3 text-xl"></i> Save All Changes
                    </button>
                    <p class="text-indigo-100 mt-4 text-sm flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Your business card will be updated immediately
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Contact section
        document.getElementById('add-contact').addEventListener('click', function() {
            const index = document.querySelectorAll('#contact-section > div').length;
            const newField = `
                <div class="item-card fade-in">
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Contact Type</label>
                            <select name="contacts[${index}][type]" class="form-input w-full px-4 py-2.5 rounded-lg">
                                <option value="mobile">📱 Mobile</option>
                                <option value="whatsapp">💬 WhatsApp</option>
                                <option value="email">✉️ Email</option>
                                <option value="website">🌐 Website</option>
                                <option value="telegram">✈️ Telegram</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Contact Value</label>
                            <input type="text" name="contacts[${index}][value]" 
                                   class="form-input w-full px-4 py-2.5 rounded-lg"
                                   placeholder="Enter contact information">
                        </div>
                        <div class="flex items-end">
                            <button type="button" class="btn-danger text-white px-4 py-2.5 rounded-lg font-medium transition"
                                    onclick="this.closest('.item-card').remove()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('contact-section').insertAdjacentHTML('beforeend', newField);
        });

        // Social media section
        document.getElementById('add-social').addEventListener('click', function() {
            const index = document.querySelectorAll('#social-section > div').length;
            const newField = `
                <div class="item-card fade-in">
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Platform</label>
                            <select name="socials[${index}][platform]" class="form-input w-full px-4 py-2.5 rounded-lg">
                                <option value="instagram">📷 Instagram</option>
                                <option value="facebook">👥 Facebook</option>
                                <option value="twitter">🐦 Twitter</option>
                                <option value="linkedin">💼 LinkedIn</option>
                                <option value="youtube">📺 YouTube</option>
                                <option value="tiktok">🎵 TikTok</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">URL</label>
                            <input type="text" name="socials[${index}][url]" 
                                   class="form-input w-full px-4 py-2.5 rounded-lg"
                                   placeholder="https://...">
                        </div>
                        <div class="flex items-end">
                            <button type="button" class="btn-danger text-white px-4 py-2.5 rounded-lg font-medium transition"
                                    onclick="this.closest('.item-card').remove()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('social-section').insertAdjacentHTML('beforeend', newField);
        });

        // Product section
        document.getElementById('add-product').addEventListener('click', function() {
            const index = document.querySelectorAll('#product-section > div').length;
            const newField = `
                <div class="product-card fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag mr-2 text-indigo-600"></i>Product Name
                            </label>
                            <input type="text" name="products[${index}][name]" 
                                   class="form-input w-full px-4 py-3 rounded-lg"
                                   placeholder="Product name">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-dollar-sign mr-2 text-indigo-600"></i>Price (AED)
                            </label>
                            <input type="number" name="products[${index}][price]" 
                                   class="form-input w-full px-4 py-3 rounded-lg"
                                   placeholder="0.00" step="0.01" min="0">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-indigo-600"></i>Description
                            </label>
                            <textarea name="products[${index}][description]" rows="3"
                                      class="form-input w-full px-4 py-3 rounded-lg resize-none"
                                      placeholder="Describe your product..."></textarea>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="products[${index}][featured]" 
                                   id="featured-${index}" 
                                   class="h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
                            <label for="featured-${index}" class="ml-3 text-sm font-medium text-gray-700">
                                <i class="fas fa-star mr-1 text-yellow-500"></i>Featured Product
                            </label>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-indigo-600"></i>Product Image
                            </label>
                            <div class="image-preview-container h-20 mb-3" id="product-preview-${index}">
                                <div id="product-placeholder-${index}" class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            </div>
                            <div class="file-input-wrapper">
                                <label for="product-input-${index}" class="file-input-label">
                                    <i class="fas fa-upload mr-2"></i>Choose Product Image
                                </label>
                                <input type="file" name="products[${index}][image]" 
                                    id="product-input-${index}"
                                    accept="image/*">
                            </div>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Recommended: 600x400 pixels, JPG/PNG
                            </p>
                        </div>
                    </div>
                    <button type="button" class="mt-4 btn-danger text-white px-4 py-2.5 rounded-lg font-medium transition"
                            onclick="this.closest('.product-card').remove()">
                        <i class="fas fa-trash mr-2"></i> Remove Product
                    </button>
                </div>
            `;
            document.getElementById('product-section').insertAdjacentHTML('beforeend', newField);
        });

        // Image preview functionality
        // Banner image preview
        const bannerInput = document.getElementById('banner-input');
        if (bannerInput) {
            bannerInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('banner-preview');
                        const placeholder = document.getElementById('banner-placeholder');
                        const existingImg = document.getElementById('banner-image');
                        
                        if (placeholder) {
                            placeholder.remove();
                        }
                        
                        if (existingImg) {
                            existingImg.src = e.target.result;
                            existingImg.style.maxWidth = '100%';
                            existingImg.style.maxHeight = '100%';
                            existingImg.style.width = '100%';
                            existingImg.style.height = '100%';
                            existingImg.style.objectFit = 'cover';
                            existingImg.style.display = 'block';
                        } else {
                            const img = document.createElement('img');
                            img.id = 'banner-image';
                            img.src = e.target.result;
                            img.className = 'w-full h-full object-cover';
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '100%';
                            img.style.width = '100%';
                            img.style.height = '100%';
                            img.style.objectFit = 'cover';
                            img.style.display = 'block';
                            img.alt = 'Banner';
                            preview.appendChild(img);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Profile image preview
        const profileInput = document.getElementById('profile-input');
        if (profileInput) {
            profileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('profile-preview');
                        const placeholder = document.getElementById('profile-placeholder');
                        const existingImg = document.getElementById('profile-image');
                        
                        if (placeholder) {
                            placeholder.remove();
                        }
                        
                        if (existingImg) {
                            existingImg.src = e.target.result;
                            existingImg.style.width = '100%';
                            existingImg.style.height = '100%';
                            existingImg.style.objectFit = 'cover';
                        } else {
                            const img = document.createElement('img');
                            img.id = 'profile-image';
                            img.src = e.target.result;
                            img.className = 'w-full h-full object-cover';
                            img.style.width = '100%';
                            img.style.height = '100%';
                            img.style.objectFit = 'cover';
                            img.alt = 'Profile';
                            preview.appendChild(img);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Product image preview functionality
        document.addEventListener('change', function(e) {
            if (e.target && e.target.matches('input[type="file"][id^="product-input-"]')) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    const inputId = e.target.id;
                    const index = inputId.replace('product-input-', '');
                    
                    reader.onload = function(event) {
                        const preview = document.getElementById('product-preview-' + index);
                        const placeholder = document.getElementById('product-placeholder-' + index);
                        const existingImg = document.getElementById('product-image-' + index);
                        
                        if (!preview) return;
                        
                        if (placeholder) {
                            placeholder.remove();
                        }
                        
                        if (existingImg) {
                            existingImg.src = event.target.result;
                            existingImg.style.maxWidth = '100%';
                            existingImg.style.maxHeight = '100%';
                            existingImg.style.width = '100%';
                            existingImg.style.height = '100%';
                            existingImg.style.objectFit = 'cover';
                            existingImg.style.display = 'block';
                        } else {
                            const img = document.createElement('img');
                            img.id = 'product-image-' + index;
                            img.src = event.target.result;
                            img.className = 'w-full h-full object-cover';
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '100%';
                            img.style.width = '100%';
                            img.style.height = '100%';
                            img.style.objectFit = 'cover';
                            img.style.display = 'block';
                            img.alt = 'Product';
                            preview.appendChild(img);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    });
</script>

@endsection
