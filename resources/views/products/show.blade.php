<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Itapp Digital</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('itappdigital_logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('itappdigital_logo.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#8b5cf6',
                        accent: '#ec4899',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-white dark:bg-slate-900 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('itappdigital_logo.svg') }}" alt="Logo" class="h-10 w-auto">
                    <span class="text-xl font-heading font-bold" style="background: linear-gradient(135deg, #784587 0%, #9d5ba8 50%, #784587 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Itapp Digital</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('public.profile', $product->profile->user->username) }}" 
                       class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">
                        View Profile
                    </a>
                    <a href="{{ route('home') }}" 
                       class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                        Home
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Product Detail Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-start">
                <!-- Product Image -->
                <div class="sticky top-24">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden">
                        @if($product->image && Storage::disk('public')->exists($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-[500px] object-cover">
                        @else
                            <div class="w-full h-[500px] bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center">
                                <i class="fas fa-image text-indigo-300 dark:text-indigo-600 text-6xl"></i>
                            </div>
                        @endif
                        @if($product->featured)
                            <div class="absolute top-6 right-6 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-2 rounded-full font-semibold text-sm shadow-lg">
                                <i class="fas fa-star mr-1"></i> Featured
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
                            {{ $product->name }}
                        </h1>
                        @if($product->price)
                            <div class="mb-6">
                                <span class="text-5xl font-bold gradient-text">${{ number_format($product->price, 2) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    @if($product->description)
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                                {{ $product->description }}
                            </p>
                        </div>
                    @endif
                    
                    <!-- Product Owner Info -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-slate-800 dark:to-slate-700 rounded-2xl p-6 border border-indigo-100 dark:border-slate-600">
                        <div class="flex items-center mb-4">
                            @if($product->profile->profile_image && Storage::disk('public')->exists($product->profile->profile_image))
                                <img src="{{ asset('storage/' . $product->profile->profile_image) }}" 
                                     alt="{{ $product->profile->user->name }}"
                                     class="w-16 h-16 rounded-full border-4 border-white dark:border-slate-800 shadow-lg mr-4">
                            @else
                                <div class="w-16 h-16 rounded-full border-4 border-white dark:border-slate-800 shadow-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-white text-xl"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">{{ $product->profile->user->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $product->profile->position ?? 'Business Owner' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('public.profile', $product->profile->user->username) }}" 
                           class="inline-flex items-center text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-800 dark:hover:text-indigo-300 transition">
                            View Full Profile <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    
                    <!-- Contact Actions -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('public.profile', $product->profile->user->username) }}" 
                           class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold text-center hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-envelope mr-2"></i> Contact Owner
                        </a>
                        <button onclick="window.history.back()" 
                                class="px-8 py-4 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 dark:hover:bg-slate-600 transition">
                            <i class="fas fa-arrow-left mr-2"></i> Go Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Itapp Digital. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

