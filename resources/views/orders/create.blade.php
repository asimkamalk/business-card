<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order {{ $product->name }} - CardPro</title>
    
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
    </style>
</head>
<body class="bg-white dark:bg-slate-900 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-id-card text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-heading font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">CardPro</span>
                </a>
                <div class="flex items-center space-x-4">
                    <button id="dark-mode-toggle" class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle dark mode">
                        <i id="dark-mode-icon" class="fas fa-moon text-lg"></i>
                    </button>
                    <a href="{{ route('home') }}" 
                       class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                        Home
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Order Form Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Product Info -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Product Details</h2>
                    
                    @if($product->image && Storage::disk('public')->exists($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-64 object-cover rounded-xl mb-4">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-image text-indigo-300 dark:text-indigo-600 text-5xl"></i>
                        </div>
                    @endif
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h3>
                    
                    @if($product->description)
                        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $product->description }}</p>
                    @endif
                    
                    <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mb-4">
                        AED {{ number_format($product->price, 2) }}
                    </div>
                    
                    @if($product->features)
                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Features:</h4>
                            <div class="text-gray-600 dark:text-gray-400 text-sm whitespace-pre-line">{{ $product->features }}</div>
                        </div>
                    @endif
                </div>
                
                <!-- Order Form -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Order Information</h2>
                    
                    <form action="{{ route('orders.store', $product->id) }}" method="POST">
                        @csrf
                        
                        <!-- Customer Name -->
                        <div class="mb-4">
                            <label for="customer_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="customer_name" 
                                   id="customer_name" 
                                   value="{{ old('customer_name') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-slate-700 dark:text-white">
                            @error('customer_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Customer Email -->
                        <div class="mb-4">
                            <label for="customer_email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="customer_email" 
                                   id="customer_email" 
                                   value="{{ old('customer_email') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-slate-700 dark:text-white">
                            @error('customer_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- WhatsApp Number -->
                        <div class="mb-4">
                            <label for="customer_whatsapp" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                WhatsApp Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="customer_whatsapp" 
                                   id="customer_whatsapp" 
                                   value="{{ old('customer_whatsapp') }}"
                                   required
                                   placeholder="+1234567890"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-slate-700 dark:text-white">
                            @error('customer_whatsapp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label for="customer_phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Phone Number (Optional)
                            </label>
                            <input type="text" 
                                   name="customer_phone" 
                                   id="customer_phone" 
                                   value="{{ old('customer_phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-slate-700 dark:text-white">
                            @error('customer_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Address -->
                        <div class="mb-4">
                            <label for="customer_address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Delivery Address (Optional)
                            </label>
                            <textarea name="customer_address" 
                                      id="customer_address" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-slate-700 dark:text-white">{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Payment Method <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center p-3 border border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                    <input type="radio" name="payment_method" value="cash" checked class="mr-3 text-indigo-600">
                                    <span class="text-gray-700 dark:text-gray-300">Cash on Delivery</span>
                                </label>
                                <label class="flex items-center p-3 border border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                    <input type="radio" name="payment_method" value="card" class="mr-3 text-indigo-600">
                                    <span class="text-gray-700 dark:text-gray-300">Card Payment</span>
                                </label>
                                <label class="flex items-center p-3 border border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="mr-3 text-indigo-600">
                                    <span class="text-gray-700 dark:text-gray-300">Bank Transfer</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Notes -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Additional Notes (Optional)
                            </label>
                            <textarea name="notes" 
                                      id="notes" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-slate-700 dark:text-white">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Total -->
                        <div class="mb-6 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900 dark:text-white">Total Amount:</span>
                                <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">AED {{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-shopping-cart mr-2"></i> Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        // Dark mode functionality
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const shouldBeDark = savedTheme === 'dark' || (!savedTheme && true); // Default to dark
            
            if (shouldBeDark) {
                document.documentElement.classList.add('dark');
                updateDarkModeIcons(true);
            } else {
                document.documentElement.classList.remove('dark');
                updateDarkModeIcons(false);
            }

            function updateDarkModeIcons(isDark) {
                const icon = document.getElementById('dark-mode-icon');
                if (icon) icon.className = isDark ? 'fas fa-sun text-lg' : 'fas fa-moon text-lg';
            }

            function toggleDarkMode() {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                updateDarkModeIcons(isDark);
            }

            document.getElementById('dark-mode-toggle')?.addEventListener('click', toggleDarkMode);
        })();
    </script>
</body>
</html>

