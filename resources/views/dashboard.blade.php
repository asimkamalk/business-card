@extends('layouts.app')

@section('header')
<h2 class="font-heading font-bold text-3xl text-white leading-tight flex items-center">
    <i class="fas fa-id-card mr-3"></i>
    {{ __('My Dashboard') }}
</h2>
<p class="text-indigo-100 mt-2">Manage your digital business card</p>
@endsection

@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .stat-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, currentColor, transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .stat-card:hover::before {
        opacity: 1;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    .business-card-preview {
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .business-card-preview:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 40px -10px rgba(102, 126, 234, 0.3);
    }
    
    .quick-action-card {
        transition: all 0.3s ease;
        background: white;
        border: 2px solid #e5e7eb;
    }
    
    .quick-action-card:hover {
        border-color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.2);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .business-card-preview img {
        max-width: 100% !important;
        max-height: 100% !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
    }
    
    .business-card-preview > div {
        overflow: hidden !important;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8 fade-in-up">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        Welcome back, <span class="gradient-text">{{ auth()->user()->name }}</span>!
                    </h1>
                    <p class="text-gray-600 text-lg">Manage your digital business card and track your engagement</p>
                </div>
                <div class="flex gap-3">
                    @if(auth()->user()->profile && auth()->user()->username)
                        <a href="{{ route('public.profile', auth()->user()->username) }}" 
                           target="_blank"
                           class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center border-2 border-indigo-200 hover:border-indigo-400">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            View Live Card
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}"
                       class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Card
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white rounded-2xl p-6 shadow-lg fade-in-up" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-eye text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">+0%</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">0</h3>
                <p class="text-sm text-gray-600 font-medium">Profile Views</p>
                <p class="text-xs text-gray-500 mt-2">Total visits to your card</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-6 shadow-lg fade-in-up" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-envelope text-green-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">+0%</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">0</h3>
                <p class="text-sm text-gray-600 font-medium">Contacts Made</p>
                <p class="text-xs text-gray-500 mt-2">People who contacted you</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-6 shadow-lg fade-in-up" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-share-alt text-purple-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">+0%</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">0</h3>
                <p class="text-sm text-gray-600 font-medium">Shares</p>
                <p class="text-xs text-gray-500 mt-2">Times your card was shared</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-6 shadow-lg fade-in-up" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-qrcode text-yellow-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full">+0%</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">0</h3>
                <p class="text-sm text-gray-600 font-medium">QR Scans</p>
                <p class="text-xs text-gray-500 mt-2">QR code scans</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Business Card Preview -->
            <div class="lg:col-span-2 fade-in-up">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4">
                                    <i class="fas fa-id-card text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-white">Your Business Card</h2>
                                    <p class="text-indigo-100 text-sm">Preview your digital card</p>
                                </div>
                            </div>
                            @if(auth()->user()->profile && auth()->user()->username)
                                <a href="{{ route('public.profile', auth()->user()->username) }}" 
                                   target="_blank"
                                   class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    View
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-8">
                        @if(auth()->user()->profile)
                            @php
                                $bannerImage = auth()->user()->profile->banner_image;
                                $profileImage = auth()->user()->profile->profile_image;
                                $hasBanner = $bannerImage && \Illuminate\Support\Facades\Storage::disk('public')->exists($bannerImage) && !\Illuminate\Support\Str::contains($bannerImage, 'default-banner');
                                $hasProfile = $profileImage && \Illuminate\Support\Facades\Storage::disk('public')->exists($profileImage) && !\Illuminate\Support\Str::contains($profileImage, 'default-avatar');
                            @endphp
                            
                            <div class="business-card-preview rounded-2xl overflow-hidden shadow-2xl">
                                <!-- Banner -->
                                @if($hasBanner)
                                    <div class="w-full h-24 overflow-hidden">
                                        <img src="{{ asset('storage/' . $bannerImage) }}"
                                            class="w-full h-full object-cover"
                                            style="max-width: 100% !important; max-height: 100% !important; width: 100% !important; height: 100% !important; object-fit: cover !important;"
                                            alt="Banner">
                                    </div>
                                @else
                                    <div class="w-full h-24 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl opacity-30"></i>
                                    </div>
                                @endif
                                
                                <!-- Profile Section -->
                                <div class="bg-white p-6 relative">
                                    <div class="relative -top-10 mb-2">
                                        @if($hasProfile)
                                            <div class="w-20 h-20 rounded-full mx-auto border-4 border-white shadow-2xl overflow-hidden">
                                                <img src="{{ asset('storage/' . $profileImage) }}"
                                                    class="w-full h-full object-cover"
                                                    style="max-width: 100% !important; max-height: 100% !important; width: 100% !important; height: 100% !important; object-fit: cover !important;"
                                                    alt="Profile">
                                            </div>
                                        @else
                                            <div class="w-20 h-20 rounded-full mx-auto border-4 border-white shadow-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                                <i class="fas fa-user text-white text-2xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="text-center mt-2">
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ auth()->user()->name }}</h3>
                                        <p class="text-indigo-600 font-semibold text-sm mb-1">{{ auth()->user()->profile->position ?? 'Business Owner' }}</p>
                                        <p class="text-gray-600 text-xs mb-3">{{ auth()->user()->profile->company ?? 'Company Name' }}</p>
                                        
                                        @if(auth()->user()->profile->bio)
                                            <p class="text-gray-600 text-sm mb-6 line-clamp-2">{{ auth()->user()->profile->bio }}</p>
                                        @endif
                                        
                                        @if(auth()->user()->profile->location)
                                            <div class="flex items-center justify-center text-gray-500 text-sm mb-6">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                {{ auth()->user()->profile->location }}
                                            </div>
                                        @endif
                                        
                                        @if(auth()->user()->profile->contactInfos && auth()->user()->profile->contactInfos->count() > 0)
                                            <div class="flex flex-wrap justify-center gap-3 mb-6">
                                                @foreach(auth()->user()->profile->contactInfos->take(3) as $contact)
                                                    <div class="bg-gray-50 px-4 py-2 rounded-lg text-sm text-gray-700">
                                                        <i class="fas fa-{{ $contact->type == 'mobile' ? 'phone' : ($contact->type == 'email' ? 'envelope' : 'globe') }} mr-2 text-indigo-600"></i>
                                                        {{ \Illuminate\Support\Str::limit($contact->value, 20) }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        @if(auth()->user()->profile->socialMedia && auth()->user()->profile->socialMedia->count() > 0)
                                            <div class="flex justify-center gap-4">
                                                @foreach(auth()->user()->profile->socialMedia->take(4) as $social)
                                                    <a href="{{ $social->url }}" target="_blank" 
                                                       class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition">
                                                        <i class="fab fa-{{ $social->platform }}"></i>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex gap-3">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Your Card
                                </a>
                                @if(auth()->user()->username)
                                    <a href="{{ route('public.profile', auth()->user()->username) }}" 
                                       target="_blank"
                                       class="flex-1 bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center border-2 border-indigo-200 hover:border-indigo-400">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        View Live
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-id-card text-indigo-600 text-4xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">No Business Card Yet</h3>
                                <p class="text-gray-600 mb-6">Create your digital business card to get started</p>
                                <a href="{{ route('profile.edit') }}"
                                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create Your Card
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-6 fade-in-up" style="animation-delay: 0.5s">
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                        Quick Actions
                    </h3>
                    <div class="space-y-4">
                        <a href="{{ route('profile.edit') }}"
                           class="quick-action-card block p-4 rounded-xl group">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-indigo-100 group-hover:bg-indigo-600 transition flex items-center justify-center mr-4">
                                    <i class="fas fa-edit text-indigo-600 group-hover:text-white transition"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition">Edit Profile</h4>
                                    <p class="text-sm text-gray-500">Update your information</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-indigo-600 transition"></i>
                            </div>
                        </a>

                        @if(auth()->user()->profile && auth()->user()->username)
                            <a href="{{ route('public.profile', auth()->user()->username) }}" 
                               target="_blank"
                               class="quick-action-card block p-4 rounded-xl group">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-xl bg-green-100 group-hover:bg-green-600 transition flex items-center justify-center mr-4">
                                        <i class="fas fa-external-link-alt text-green-600 group-hover:text-white transition"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 group-hover:text-green-600 transition">View Live Card</h4>
                                        <p class="text-sm text-gray-500">See your public profile</p>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400 group-hover:text-green-600 transition"></i>
                                </div>
                            </a>
                        @endif

                        <div class="quick-action-card block p-4 rounded-xl group cursor-pointer">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-purple-100 group-hover:bg-purple-600 transition flex items-center justify-center mr-4">
                                    <i class="fas fa-share-alt text-purple-600 group-hover:text-white transition"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-purple-600 transition">Share Card</h4>
                                    <p class="text-sm text-gray-500">Share with others</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600 transition"></i>
                            </div>
                        </div>

                        <div class="quick-action-card block p-4 rounded-xl group cursor-pointer">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-yellow-100 group-hover:bg-yellow-600 transition flex items-center justify-center mr-4">
                                    <i class="fas fa-qrcode text-yellow-600 group-hover:text-white transition"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-yellow-600 transition">Download QR</h4>
                                    <p class="text-sm text-gray-500">Get your QR code</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-yellow-600 transition"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
