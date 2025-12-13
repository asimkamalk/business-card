@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo and Header -->
        <div class="text-center fade-in">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center justify-center mb-6 group">
                <div class="flex items-center space-x-3 mb-2">
                    <img src="{{ asset('itappdigital_logo.svg') }}" alt="Logo" class="h-16 w-auto group-hover:scale-110 transition-all duration-300">
                    <span class="text-2xl font-heading font-bold" style="background: linear-gradient(135deg, #784587 0%, #9d5ba8 50%, #784587 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Itapp Digital</span>
                </div>
            </a>
            <h2 class="text-4xl font-heading font-bold text-gray-900 dark:text-white mb-2">
                Create Your <span class="gradient-text">Account</span>
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Start building your digital business card today</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-8 border border-gray-100 dark:border-slate-700 fade-in" style="animation-delay: 0.1s">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-user mr-2 text-indigo-600"></i>{{ __('Full Name') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus
                            class="block mt-1 w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white dark:bg-slate-700 text-gray-900 dark:text-white"
                            placeholder="John Doe">
                    </div>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-at mr-2 text-indigo-600"></i>{{ __('Username') }}
                    </label>
                    <div class="flex items-center bg-gray-50 dark:bg-slate-700 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus-within:border-indigo-500 transition">
                        <div class="bg-white dark:bg-slate-800 text-gray-600 dark:text-gray-400 px-4 py-3 rounded-l-lg border-r border-gray-200 dark:border-gray-600 font-medium text-sm">
                            {{ config('app.url') }}/
                        </div>
                        <input id="username" 
                            type="text" 
                            name="username" 
                            value="{{ old('username') }}" 
                            required
                            class="flex-1 px-4 py-3 bg-transparent border-0 focus:ring-0 text-gray-900 dark:text-white font-medium"
                            placeholder="your-username">
                    </div>
                    @error('username')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        This will be your profile URL
                    </p>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-envelope mr-2 text-indigo-600"></i>{{ __('Email Address') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            class="block mt-1 w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white dark:bg-slate-700 text-gray-900 dark:text-white"
                            placeholder="you@example.com">
                    </div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>{{ __('Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="block mt-1 w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white dark:bg-slate-700 text-gray-900 dark:text-white"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>{{ __('Confirm Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            class="block mt-1 w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white dark:bg-slate-700 text-gray-900 dark:text-white"
                            placeholder="••••••••">
                    </div>
                    @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full btn-primary text-white px-6 py-4 rounded-xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02]">
                        <i class="fas fa-user-plus mr-2"></i>
                        {{ __('Create Account') }}
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center pt-4 border-t border-gray-200 dark:border-slate-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-semibold transition">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to home
            </a>
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

<style>
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
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

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
</style>
@endsection
