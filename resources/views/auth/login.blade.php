<x-guest-layout>
    <!-- Dark Mode Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button id="dark-mode-toggle" class="p-3 rounded-lg bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors shadow-lg" aria-label="Toggle dark mode">
            <i id="dark-mode-icon" class="fas fa-moon text-lg"></i>
        </button>
    </div>
    
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
                    Welcome <span class="gradient-text">Back</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">Sign in to access your digital business card</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 bg-blue-50 border-l-4 border-blue-500 text-blue-800 px-4 py-3 rounded-lg" :status="session('status')" />

            <!-- Login Form -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-8 border border-gray-100 dark:border-slate-700 fade-in" style="animation-delay: 0.1s">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-semibold mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <x-text-input id="email" 
                                class="block mt-1 w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white dark:bg-slate-700 text-gray-900 dark:text-white" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="username" 
                                placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-semibold mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <x-text-input id="password" 
                                class="block mt-1 w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition bg-white dark:bg-slate-700 text-gray-900 dark:text-white"
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full btn-primary text-white px-6 py-4 rounded-xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            {{ __('Sign In') }}
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center pt-4 border-t border-gray-200 dark:border-slate-700">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-semibold transition">
                                Create one now
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
</x-guest-layout>
