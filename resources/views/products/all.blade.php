<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Itapp Digital</title>
    
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
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}#features" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Features</a>
                    <a href="{{ route('home') }}#how-it-works" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">How It Works</a>
                    <a href="{{ route('products.all') }}" class="text-indigo-600 dark:text-indigo-400 font-semibold transition">All Products</a>
                    <a href="{{ route('home') }}#testimonials" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Testimonials</a>
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Login</a>
                    <button id="dark-mode-toggle" class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle dark mode">
                        <i id="dark-mode-icon" class="fas fa-moon text-lg"></i>
                    </button>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">Get Started</a>
                </div>
                <div class="md:hidden flex items-center space-x-3">
                    <button id="dark-mode-toggle-mobile" class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle dark mode">
                        <i id="dark-mode-icon-mobile" class="fas fa-moon text-lg"></i>
                    </button>
                    <button id="mobile-menu-btn" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Products Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
                    All <span class="gradient-text">Products</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Browse our complete collection of premium NFC business cards
                </p>
            </div>

            @if($products->count() > 0)
                <!-- Products Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                    @foreach($products as $product)
                        <a href="{{ route('orders.create', $product->id) }}" class="group bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 block cursor-pointer">
                            <!-- Product Image -->
                            <div class="relative h-64 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 overflow-hidden">
                                @if($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-credit-card text-indigo-300 dark:text-indigo-600 text-5xl"></i>
                                    </div>
                                @endif
                                @if($product->featured)
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg z-10">
                                        <i class="fas fa-star mr-1"></i> Featured
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-heading font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                    {{ $product->name }}
                                </h3>
                                
                                @if($product->description)
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                        {{ $product->description }}
                                    </p>
                                @endif
                                
                                @if($product->features)
                                    <div class="mb-4">
                                        <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                            @foreach(explode("\n", $product->features) as $feature)
                                                @if(trim($feature))
                                                    <li class="flex items-start">
                                                        <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                                        <span class="line-clamp-1">{{ trim($feature) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-2xl font-bold gradient-text">AED {{ number_format($product->price, 2) }}</span>
                                    @if($product->stock_quantity !== null)
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $product->stock_quantity }} in stock</span>
                                    @endif
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex gap-3">
                                    <div class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-3 rounded-xl font-semibold text-center text-sm">
                                        <i class="fas fa-shopping-cart mr-2"></i> Order Now
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-credit-card text-indigo-600 dark:text-indigo-400 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Products Available</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">We're preparing amazing NFC card products for you. Check back soon!</p>
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Home
                    </a>
                </div>
            @endif
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Itapp Digital. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        // Dark mode functionality
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const shouldBeDark = savedTheme === 'dark' || (!savedTheme && true);
            
            if (shouldBeDark) {
                document.documentElement.classList.add('dark');
                updateDarkModeIcons(true);
            } else {
                document.documentElement.classList.remove('dark');
                updateDarkModeIcons(false);
            }

            function updateDarkModeIcons(isDark) {
                const icon = document.getElementById('dark-mode-icon');
                const iconMobile = document.getElementById('dark-mode-icon-mobile');
                if (icon) icon.className = isDark ? 'fas fa-sun text-lg' : 'fas fa-moon text-lg';
                if (iconMobile) iconMobile.className = isDark ? 'fas fa-sun text-lg' : 'fas fa-moon text-lg';
            }

            function toggleDarkMode() {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                updateDarkModeIcons(isDark);
            }

            document.getElementById('dark-mode-toggle')?.addEventListener('click', toggleDarkMode);
            document.getElementById('dark-mode-toggle-mobile')?.addEventListener('click', toggleDarkMode);
        })();
    </script>
</body>
</html>

