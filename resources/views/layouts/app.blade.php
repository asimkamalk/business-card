<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Itapp Digital - {{ $header ?? 'Dashboard' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('itappdigital_logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('itappdigital_logo.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        .dark body {
            background: linear-gradient(to bottom, #0f172a 0%, #1e293b 100%);
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

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
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

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-blur {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .dark .nav-blur {
            background: rgba(15, 23, 42, 0.9);
        }
    </style>
</head>

<body class="font-sans antialiased bg-white dark:bg-slate-900">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-800 dark:via-purple-800 dark:to-pink-800 text-white shadow-lg">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="fade-in">
                    {{ $header }}
                </div>
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 dark:border-green-400 text-green-800 dark:text-green-200 px-6 py-4 rounded-lg shadow-md fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-400 text-red-800 dark:text-red-200 px-6 py-4 rounded-lg shadow-md fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    
    <script>
        // Dark mode functionality - sync with home page
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
