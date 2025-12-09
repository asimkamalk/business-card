<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - CardPro</title>
    
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
</head>
<body class="bg-white dark:bg-slate-900 min-h-screen">
    <!-- Dark Mode Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button id="dark-mode-toggle" class="p-3 rounded-lg bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors shadow-lg" aria-label="Toggle dark mode">
            <i id="dark-mode-icon" class="fas fa-moon text-lg"></i>
        </button>
    </div>
    
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-2xl w-full text-center">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 md:p-12">
                <div class="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-green-600 dark:text-green-400 text-4xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Order Confirmed!</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-8">
                    Thank you for your order, <strong>{{ $order->customer_name }}</strong>! We have received your order and will contact you soon via WhatsApp or email.
                </p>
                
                <div class="bg-gray-50 dark:bg-slate-700 rounded-xl p-6 mb-6 text-left">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Order Details:</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Order ID:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">#{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Product:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $order->adminProduct->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Total Amount:</span>
                            <span class="font-semibold text-indigo-600 dark:text-indigo-400">AED {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Payment Method:</span>
                            <span class="font-semibold text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Status:</span>
                            <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-semibold capitalize">{{ $order->status }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}"
                       class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-home mr-2"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
    
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

