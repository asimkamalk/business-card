<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $user->name }}'s digital business card">
    <title>{{ $user->name }}'s Business Card</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @php
        $theme = $profile->theme ?? 'modern';
        $themeStyles = [
            'modern' => [
                'body' => 'background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 50%, #f5f3ff 100%);',
                'banner' => 'bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500',
                'iconBg' => 'bg-gradient-to-br from-indigo-100 to-purple-100',
                'iconText' => 'text-indigo-700',
                'text' => 'text-indigo-700',
                'heading' => 'text-gray-900',
                'bodyText' => 'text-gray-700',
                'secondaryText' => 'text-gray-600',
                'button' => 'bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-lg hover:shadow-xl',
                'card' => 'bg-white border-2 border-indigo-100 shadow-md hover:shadow-lg',
                'badge' => 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 border border-indigo-200',
            ],
            'classic' => [
                'body' => 'background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #e0f2fe 100%);',
                'banner' => 'bg-gradient-to-br from-blue-600 via-cyan-600 to-teal-500',
                'iconBg' => 'bg-gradient-to-br from-blue-100 to-cyan-100',
                'iconText' => 'text-blue-700',
                'text' => 'text-blue-700',
                'heading' => 'text-gray-900',
                'bodyText' => 'text-gray-700',
                'secondaryText' => 'text-gray-600',
                'button' => 'bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 shadow-lg hover:shadow-xl',
                'card' => 'bg-white border-2 border-blue-100 shadow-md hover:shadow-lg',
                'badge' => 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border border-blue-200',
            ],
            'minimal' => [
                'body' => 'background: linear-gradient(135deg, #ffffff 0%, #f9fafb 50%, #f3f4f6 100%);',
                'banner' => 'bg-gradient-to-br from-slate-600 via-gray-600 to-zinc-700',
                'iconBg' => 'bg-gradient-to-br from-slate-100 to-gray-100',
                'iconText' => 'text-slate-700',
                'text' => 'text-slate-700',
                'heading' => 'text-gray-900',
                'bodyText' => 'text-gray-700',
                'secondaryText' => 'text-gray-600',
                'button' => 'bg-gradient-to-r from-slate-700 to-gray-800 hover:from-slate-800 hover:to-gray-900 shadow-lg hover:shadow-xl',
                'card' => 'bg-white border-2 border-slate-200 shadow-md hover:shadow-lg',
                'badge' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border border-slate-200',
            ],
            'dark' => [
                'body' => 'background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);',
                'banner' => 'bg-gradient-to-br from-slate-900 via-gray-900 to-black',
                'iconBg' => 'bg-gradient-to-br from-slate-700 to-gray-800',
                'iconText' => 'text-slate-200',
                'text' => 'text-slate-200',
                'heading' => 'text-white',
                'bodyText' => 'text-slate-200',
                'secondaryText' => 'text-slate-400',
                'button' => 'bg-gradient-to-r from-slate-700 to-gray-800 hover:from-slate-600 hover:to-gray-700 shadow-lg hover:shadow-xl border border-slate-600',
                'card' => 'bg-slate-800 border-2 border-slate-700 shadow-lg hover:shadow-xl',
                'badge' => 'bg-gradient-to-r from-slate-700 to-gray-800 text-slate-200 border border-slate-600',
            ],
            'colorful' => [
                'body' => 'background: linear-gradient(135deg, #fef3f2 0%, #fce7f3 25%, #f3e8ff 50%, #e9d5ff 75%, #ddd6fe 100%);',
                'banner' => 'bg-gradient-to-br from-pink-500 via-purple-500 via-indigo-500 to-cyan-500',
                'iconBg' => 'bg-gradient-to-br from-pink-100 via-purple-100 to-indigo-100',
                'iconText' => 'text-pink-700',
                'text' => 'text-pink-700',
                'heading' => 'text-gray-900',
                'bodyText' => 'text-gray-700',
                'secondaryText' => 'text-gray-600',
                'button' => 'bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-600 hover:from-pink-600 hover:via-purple-700 hover:to-indigo-700 shadow-lg hover:shadow-xl',
                'card' => 'bg-white border-2 border-pink-200 shadow-md hover:shadow-lg',
                'badge' => 'bg-gradient-to-r from-pink-100 via-purple-100 to-indigo-100 text-pink-800 border border-pink-200',
            ],
        ];
        $currentTheme = $themeStyles[$theme] ?? $themeStyles['modern'];
    @endphp
    <style>
        body {
            font-family: 'Inter', sans-serif;
            {{ $currentTheme['body'] }}
            min-height: 100vh;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        .gradient-border {
            position: relative;
            border-radius: 1.5rem;
        }
        .gradient-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, #6366f1, #8b5cf6, #ec4899);
            border-radius: inherit;
            z-index: -1;
        }
        .card-gradient {
            background: linear-gradient(135deg, #f0f9ff 0%, #f0f9ff 50%, #e0f2fe 100%);
        }
        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #3b82f6, #8b5cf6, #ec4899);
        }
        .contact-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .contact-card:hover {
            transform: translateY(-8px) scale(1.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }
        .social-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .social-icon:hover {
            transform: scale(1.15) rotate(5deg);
        }
        
        /* Enhanced banner animations */
        .banner-gradient {
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Enhanced button styles */
        .theme-button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .theme-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .theme-button:hover::before {
            left: 100%;
        }
    </style>
    <script>
        // Define global functions immediately
        function showNotification(message) {
            const existing = document.querySelector('.share-notification');
            if (existing) {
                existing.remove();
            }

            const notification = document.createElement('div');
            notification.className = 'share-notification fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl z-[100] flex items-center space-x-2';
            notification.innerHTML = '<i class="fas fa-check-circle"></i><span>' + message + '</span>';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.3s';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        function copyToClipboard() {
            const url = window.location.href;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    showNotification('Link copied to clipboard!');
                }).catch(() => {
                    fallbackCopyToClipboard(url);
                });
            } else {
                fallbackCopyToClipboard(url);
            }
        }

        function fallbackCopyToClipboard(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '0';
            textArea.setAttribute('readonly', '');
            document.body.appendChild(textArea);
            textArea.select();
            textArea.setSelectionRange(0, 99999);
            
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    showNotification('Link copied to clipboard!');
                } else {
                    showNotification('Failed to copy. Please copy manually.');
                }
            } catch (err) {
                showNotification('Failed to copy link.');
            }
            document.body.removeChild(textArea);
        }

        function handleShare() {
            const shareData = {
                title: "{{ $user->name }}'s Business Card",
                text: "Check out {{ $user->name }}'s digital business card!",
                url: window.location.href
            };
            
            if (navigator.share) {
                navigator.share(shareData)
                    .then(() => {
                        showNotification('Shared successfully!');
                    })
                    .catch(err => {
                        if (err.name !== 'AbortError') {
                            copyToClipboard();
                        }
                    });
            } else {
                copyToClipboard();
            }
        }

        function handleQRCode() {
            const qrModal = document.getElementById('qrModal');
            if (qrModal) {
                qrModal.style.display = 'flex';
            }
        }

        function closeQRModal() {
            const qrModal = document.getElementById('qrModal');
            if (qrModal) {
                qrModal.style.display = 'none';
            }
        }

        function downloadQRCode() {
            const qrModal = document.getElementById('qrModal');
            const qrImage = qrModal ? qrModal.querySelector('img') : null;
            const qrSvg = qrModal ? qrModal.querySelector('svg') : null;
            
            if (qrImage && qrImage.src) {
                try {
                    const link = document.createElement('a');
                    link.download = "{{ str_replace(' ', '-', $user->name) }}-business-card-qr.png";
                    link.href = qrImage.src;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    showNotification('QR code downloaded!');
                } catch (err) {
                    showNotification('Please right-click on the QR code and save as image.');
                }
            } else if (qrSvg) {
                showNotification('Please right-click on the QR code and save as image.');
            } else {
                showNotification('QR code not found.');
            }
        }
    </script>
</head>
<body class="font-sans antialiased min-h-screen">
    <!-- Banner with profile image -->
    <div class="relative h-64">
        @php
            $hasBanner = $profile && $profile->banner_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->banner_image) && !\Illuminate\Support\Str::contains($profile->banner_image, 'default-banner');
            $hasProfile = $profile && $profile->profile_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->profile_image) && !\Illuminate\Support\Str::contains($profile->profile_image, 'default-avatar');
        @endphp
        <div class="w-full h-full {{ $currentTheme['banner'] }} banner-gradient overflow-hidden">
            @if($hasBanner)
                <img src="{{ asset('storage/' . $profile->banner_image) }}" 
                     class="w-full h-full object-cover opacity-20"
                     style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover;"
                     alt="Banner">
            @else
                <div class="w-full h-full {{ $currentTheme['banner'] }} flex items-center justify-center">
                    <span class="text-white text-opacity-50 text-lg">Banner</span>
                </div>
            @endif
        </div>
        <div class="absolute -bottom-20 left-6 w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-xl floating" style="width: 128px; height: 128px; flex-shrink: 0;">
            @if($hasProfile)
                <img src="{{ asset('storage/' . $profile->profile_image) }}" 
                     class="w-full h-full object-cover bg-white"
                     style="width: 100%; height: 100%; object-fit: cover;"
                     alt="{{ $user->name }}">
            @else
                <div class="w-full h-full {{ $currentTheme['banner'] }} flex items-center justify-center">
                    <i class="fas fa-user text-white text-4xl"></i>
                </div>
            @endif
        </div>
    </div>

    <div class="px-4 pt-24 pb-8 max-w-2xl mx-auto">
        <!-- Profile info -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold font-heading {{ $currentTheme['heading'] }} mb-1">{{ $user->name }}</h1>
            <div class="flex flex-col md:flex-row md:justify-center md:space-x-4 space-y-2 md:space-y-0">
                <span class="text-lg font-medium {{ $currentTheme['text'] }}">{{ $profile->position ?? 'Business Owner' }}</span>
                <span class="{{ $currentTheme['secondaryText'] }}">•</span>
                <span class="text-lg {{ $currentTheme['bodyText'] }}">{{ $profile->company ?? 'Company Name' }}</span>
            </div>
            <p class="{{ $currentTheme['bodyText'] }} mt-2 max-w-md mx-auto">{{ $profile->bio ?? 'Welcome to my digital business card. Connect with me through any of the channels below.' }}</p>
        </div>
        
            <div class="flex justify-center mb-8">
            <button id="connectBtn" class="theme-button flex items-center {{ $currentTheme['button'] }} text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl">
                <i class="fas fa-user-plus mr-2"></i> CONNECT NOW
            </button>
        </div>

        <!-- Social Media -->
        @if($profile && $profile->socialMedia && $profile->socialMedia->count() > 0)
        <div class="flex justify-center mb-10">
            @foreach($profile->socialMedia as $media)
                <a href="{{ $media->url }}" target="_blank" class="mx-3 text-2xl hover:scale-110 transition-transform duration-300">
                    @if($media->platform == 'instagram')
                        <i class="fab fa-instagram text-pink-500 hover:text-pink-600"></i>
                    @elseif($media->platform == 'facebook')
                        <i class="fab fa-facebook text-blue-600 hover:text-blue-700"></i>
                    @elseif($media->platform == 'twitter')
                        <i class="fab fa-twitter text-sky-400 hover:text-sky-500"></i>
                    @elseif($media->platform == 'linkedin')
                        <i class="fab fa-linkedin text-blue-700 hover:text-blue-800"></i>
                    @elseif($media->platform == 'youtube')
                        <i class="fab fa-youtube text-red-600 hover:text-red-700"></i>
                    @elseif($media->platform == 'tiktok')
                        <i class="fab fa-tiktok text-black hover:text-gray-800"></i>
                    @endif
                </a>
            @endforeach
        </div>
        @endif

        <!-- Contact Information -->
        @if($profile && $profile->contactInfos && $profile->contactInfos->count() > 0)
        <div id="contact-section" class="mb-10">
            <h2 class="text-xl font-bold font-heading {{ $currentTheme['heading'] }} mb-4 text-center">Contact Information</h2>
            <div class="space-y-3">
                @foreach($profile->contactInfos as $info)
                    @php
                        $contactUrl = '';
                        if ($info->type == 'mobile') {
                            $contactUrl = 'tel:' . preg_replace('/[^0-9+]/', '', $info->value);
                        } elseif ($info->type == 'whatsapp') {
                            $phoneNumber = preg_replace('/[^0-9]/', '', $info->value);
                            $contactUrl = 'https://wa.me/' . $phoneNumber;
                        } elseif ($info->type == 'email') {
                            $contactUrl = 'mailto:' . $info->value;
                        } elseif ($info->type == 'website') {
                            $contactUrl = (strpos($info->value, 'http') === 0 ? '' : 'https://') . $info->value;
                        } elseif ($info->type == 'telegram') {
                            $username = str_replace(['@', 'https://t.me/', 'http://t.me/'], '', $info->value);
                            $contactUrl = 'https://t.me/' . $username;
                        }
                    @endphp
                    <a href="{{ $contactUrl ? $contactUrl : '#' }}" 
                       {{ $contactUrl ? '' : 'onclick="return false;"' }}
                       class="contact-card {{ $currentTheme['card'] }} rounded-xl p-4 shadow-md hover:shadow-lg transition-shadow border block cursor-pointer">
                        <div class="flex items-start">
                            <div class="{{ $currentTheme['iconBg'] }} {{ $currentTheme['iconText'] }} p-3 rounded-xl mr-4 flex-shrink-0">
                                @if($info->type == 'mobile')
                                    <i class="fas fa-phone text-xl"></i>
                                @elseif($info->type == 'whatsapp')
                                    <i class="fab fa-whatsapp text-xl text-green-500"></i>
                                @elseif($info->type == 'email')
                                    <i class="fas fa-envelope text-xl"></i>
                                @elseif($info->type == 'website')
                                    <i class="fas fa-globe text-xl"></i>
                                @elseif($info->type == 'telegram')
                                    <i class="fab fa-telegram text-xl text-blue-400"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm {{ $currentTheme['secondaryText'] }} mb-1 capitalize">{{ $info->type }}</p>
                                <p class="font-medium {{ $currentTheme['heading'] }} truncate">{{ $info->value }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Products -->
        @if($profile && $profile->products && $profile->products->count() > 0)
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold font-heading {{ $currentTheme['heading'] }}">Featured Products</h2>
                <span class="text-sm {{ $currentTheme['text'] }} font-medium">{{ $profile->products->count() }} items</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($profile->products->take(4) as $product)
                    <div class="product-card gradient-border rounded-xl overflow-hidden {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-white' }} shadow-md hover:shadow-xl transition-shadow">
                        <div class="relative h-40 overflow-hidden">
                            @php
                                $hasProductImage = $product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image) && !\Illuminate\Support\Str::contains($product->image, 'default-property');
                            @endphp
                            @if($hasProductImage)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     class="w-full h-full object-cover"
                                     style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover;"
                                     alt="{{ $product->name }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-3xl"></i>
                                </div>
                            @endif
                            @if($product->featured)
                                <div class="absolute top-2 right-2 bg-yellow-400 text-black text-xs font-bold px-2 py-1 rounded">
                                    Featured
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg {{ $currentTheme['heading'] }} truncate">{{ $product->name }}</h3>
                                @if($product->price)
                                    <span class="{{ $currentTheme['badge'] }} text-sm font-medium px-2 py-1 rounded">
                                        AED {{ number_format($product->price, 2) }}
                                    </span>
                                @endif
                            </div>
                            <p class="{{ $currentTheme['bodyText'] }} text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Location -->
        @if($profile && $profile->location)
        <div class="{{ $currentTheme['card'] }} rounded-xl p-4 mb-10 shadow-md border">
            <div class="flex items-start">
                <div class="{{ $currentTheme['iconBg'] }} {{ $currentTheme['iconText'] }} p-3 rounded-xl mr-4 flex-shrink-0">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm {{ $currentTheme['secondaryText'] }} mb-1">Location</p>
                    <p class="font-medium {{ $currentTheme['heading'] }}">{{ $profile->location }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="fixed bottom-6 right-6 flex flex-col space-y-4 z-50">
            <!-- Share Button -->
            <button id="shareBtn" 
                    type="button"
                    onclick="handleShare()"
                    class="bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition transform hover:scale-110 cursor-pointer">
                <i class="fas fa-share-alt text-xl"></i>
            </button>
            
            <!-- QR Code Button -->
            <button id="qrBtn" 
                    type="button"
                    onclick="handleQRCode()"
                    class="{{ $currentTheme['button'] }} text-white p-4 rounded-full shadow-lg transition transform hover:scale-110 cursor-pointer">
                <i class="fas fa-qrcode text-xl"></i>
            </button>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60]" style="display: none;">
        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-white' }} p-6 rounded-2xl w-80 mx-4 shadow-xl max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation(); return false;">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg {{ $currentTheme['heading'] }}">Scan to Save Contact</h3>
                <button id="closeQRModal" 
                        type="button"
                        onclick="closeQRModal()"
                        class="{{ $currentTheme['secondaryText'] }} hover:opacity-70 transition p-2 hover:bg-gray-100 rounded-lg cursor-pointer">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex justify-center mb-4 p-4 {{ $theme === 'dark' ? 'bg-gray-700' : 'bg-gray-50' }} rounded-xl">
                {!! $qrcode ?? '<p class="text-center text-gray-500">QR code not available</p>' !!}
            </div>
            <p class="text-center {{ $currentTheme['bodyText'] }} mb-4 text-sm">
                Point your camera at the QR code to save this contact to your phone
            </p>
            <div class="flex space-x-3">
                <button id="cancelQRModal" 
                        type="button"
                        onclick="closeQRModal()"
                        class="flex-1 {{ $theme === 'dark' ? 'bg-gray-700 text-gray-200 hover:bg-gray-600' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }} py-3 rounded-lg font-medium transition cursor-pointer">
                    Cancel
                </button>
                <button id="downloadQRBtn" 
                        type="button"
                        onclick="downloadQRCode()"
                        class="flex-1 {{ $currentTheme['button'] }} text-white py-3 rounded-lg font-medium transition hover:opacity-90 cursor-pointer">
                    <i class="fas fa-download mr-2"></i>Download QR
                </button>
            </div>
        </div>
    </div>

    <script>
        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Close modal when clicking outside
            const qrModal = document.getElementById('qrModal');
            if (qrModal) {
                qrModal.onclick = function(e) {
                    if (e.target === this) {
                        closeQRModal();
                    }
                };
            }

            // Connect Now button
            const connectBtn = document.getElementById('connectBtn');
            if (connectBtn) {
                connectBtn.onclick = function(e) {
                    e.preventDefault();
                    const contactSection = document.getElementById('contact-section');
                    if (contactSection) {
                        contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        const firstContact = document.querySelector('.contact-card');
                        if (firstContact) {
                            firstContact.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                };
            }
        });