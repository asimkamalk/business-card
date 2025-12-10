<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $product->name }} - {{ $user->name }}'s product">
    <title>{{ $product->name }} - {{ $user->name }}'s Business Card</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @php
        $theme = $profile->theme ?? 'modern';
        $themeFonts = [
            'modern' => 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap',
            'classic' => 'https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap',
            'minimal' => 'https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&family=DM+Sans:wght@400;500;600;700&display=swap',
            'dark' => 'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Orbitron:wght@400;500;600;700&display=swap',
            'colorful' => 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Comfortaa:wght@400;500;600;700&display=swap',
        ];
        $fontLink = $themeFonts[$theme] ?? $themeFonts['modern'];
    @endphp
    <link href="{{ $fontLink }}" rel="stylesheet">
    
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
        $themeFonts = [
            'modern' => ['body' => "'Inter', sans-serif", 'heading' => "'Space Grotesk', sans-serif"],
            'classic' => ['body' => "'Crimson Text', serif", 'heading' => "'Playfair Display', serif"],
            'minimal' => ['body' => "'Work Sans', sans-serif", 'heading' => "'DM Sans', sans-serif"],
            'dark' => ['body' => "'JetBrains Mono', monospace", 'heading' => "'Orbitron', sans-serif"],
            'colorful' => ['body' => "'Nunito', sans-serif", 'heading' => "'Comfortaa', cursive"],
        ];
        $fonts = $themeFonts[$theme] ?? $themeFonts['modern'];
    @endphp
    <style>
        body {
            font-family: {{ $fonts['body'] }};
            {{ $currentTheme['body'] }}
            min-height: 100vh;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: {{ $fonts['heading'] }};
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen">
    <div class="px-4 py-8 max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('public.profile', $user->username) }}" class="inline-flex items-center {{ $currentTheme['text'] }} mb-6 hover:opacity-80 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Profile
        </a>

        <!-- Product Card -->
        <div class="{{ $currentTheme['card'] }} rounded-2xl overflow-hidden shadow-xl">
            <!-- Product Image -->
            <div class="relative h-96 overflow-hidden">
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
                        <i class="fas fa-image text-gray-400 text-6xl"></i>
                    </div>
                @endif
                @if($product->featured)
                    <div class="absolute top-4 right-4 bg-yellow-400 text-black text-sm font-bold px-4 py-2 rounded-lg shadow-lg">
                        <i class="fas fa-star mr-1"></i> Featured
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="p-8">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-4xl font-bold {{ $currentTheme['heading'] }}">{{ $product->name }}</h1>
                    @if($product->price)
                        <span class="{{ $currentTheme['badge'] }} text-xl font-bold px-4 py-2 rounded-lg">
                            AED {{ number_format($product->price, 2) }}
                        </span>
                    @endif
                </div>

                @if($product->description)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold {{ $currentTheme['heading'] }} mb-3">Description</h2>
                        <p class="{{ $currentTheme['bodyText'] }} text-lg leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
                    </div>
                @endif

                @if($product->product_link_url)
                    <div class="mt-6">
                        <a href="{{ $product->product_link_url }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="{{ $currentTheme['button'] }} text-white px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center shadow-lg hover:shadow-xl transition">
                            <i class="fas fa-external-link-alt mr-2"></i> View Product
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Profile Info -->
        <div class="mt-8 {{ $currentTheme['card'] }} rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-lg mr-4">
                    @php
                        $hasProfile = $profile && $profile->profile_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->profile_image) && !\Illuminate\Support\Str::contains($profile->profile_image, 'default-avatar');
                    @endphp
                    @if($hasProfile)
                        <img src="{{ asset('storage/' . $profile->profile_image) }}" 
                             class="w-full h-full object-cover"
                             style="width: 100%; height: 100%; object-fit: cover;"
                             alt="{{ $user->name }}">
                    @else
                        <div class="w-full h-full {{ $currentTheme['banner'] }} flex items-center justify-center">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="text-xl font-bold {{ $currentTheme['heading'] }}">{{ $user->name }}</h3>
                    <p class="{{ $currentTheme['secondaryText'] }}">{{ $profile->position ?? 'Business Owner' }}</p>
                    <a href="{{ route('public.profile', $user->username) }}" class="text-sm {{ $currentTheme['text'] }} hover:opacity-80 transition">
                        View Full Profile <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

