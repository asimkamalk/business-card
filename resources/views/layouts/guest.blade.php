<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Itapp Digital</title>

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
        @php
            try {
                $viteManifest = public_path('build/manifest.json');
                if (file_exists($viteManifest)) {
                    echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']);
                } else {
                    // Fallback: Load Alpine.js via CDN if Vite manifest doesn't exist
                    echo '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>';
                }
            } catch (\Exception $e) {
                // Fallback: Load Alpine.js via CDN if Vite fails
                echo '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>';
            }
        @endphp

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
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased bg-white dark:bg-slate-900">
        {{ $slot }}
        
        <script>
            // Dark mode functionality - sync with home page
            (function() {
                const savedTheme = localStorage.getItem('theme');
                const shouldBeDark = savedTheme === 'dark' || (!savedTheme && true); // Default to dark
                
                if (shouldBeDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>
    </body>
</html>
