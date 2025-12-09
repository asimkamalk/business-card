<nav x-data="{ open: false }" class="nav-blur border-b border-gray-200 dark:border-slate-700 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ auth()->check() && auth()->user()->is_admin ? route('admin.dashboard') : (auth()->check() ? route('dashboard') : route('home')) }}" class="flex items-center space-x-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                            <i class="fas fa-id-card text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-heading font-bold gradient-text">CardPro</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                    @if(auth()->user()->is_admin)
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="px-4 py-2 rounded-lg transition-all duration-300 hover:bg-indigo-50 dark:hover:bg-slate-700">
                        <i class="fas fa-chart-line mr-2"></i> Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="px-4 py-2 rounded-lg transition-all duration-300 hover:bg-indigo-50 dark:hover:bg-slate-700">
                        <i class="fas fa-users mr-2"></i> Users
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2 rounded-lg transition-all duration-300 hover:bg-indigo-50 dark:hover:bg-slate-700">
                        <i class="fas fa-id-card mr-2"></i> My Card
                    </x-nav-link>
                    @endif
                    @endauth
                </div>
            </div>

            <div class="flex items-center">
                <!-- Settings Dropdown -->
                @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition ease-in-out duration-150 shadow-sm hover:shadow-md">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold mr-2">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(auth()->user()->is_admin)
                            <x-dropdown-link :href="route('admin.dashboard')" class="hover:bg-indigo-50 dark:hover:bg-slate-700">
                                <i class="fas fa-tachometer-alt mr-2 text-indigo-600 dark:text-indigo-400"></i> Admin Dashboard
                            </x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-50 dark:hover:bg-slate-700">
                                <i class="fas fa-edit mr-2 text-indigo-600 dark:text-indigo-400"></i> Edit Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-red-50 text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endauth

                @guest
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button id="dark-mode-toggle" class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors" aria-label="Toggle dark mode">
                        <i id="dark-mode-icon" class="fas fa-moon text-lg"></i>
                    </button>
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:bg-indigo-50 dark:hover:bg-slate-700">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-semibold">
                        Register
                    </a>
                </div>
                @endguest

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-slate-700 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
            @if(auth()->user()->is_admin)
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="px-4 py-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-slate-700">
                <i class="fas fa-chart-line mr-2 text-indigo-600 dark:text-indigo-400"></i> Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="px-4 py-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-slate-700">
                <i class="fas fa-users mr-2 text-indigo-600 dark:text-indigo-400"></i> Users
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-slate-700">
                <i class="fas fa-id-card mr-2 text-indigo-600 dark:text-indigo-400"></i> My Card
            </x-responsive-nav-link>
            @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-slate-700">
            @auth
            <div class="px-4 mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold mr-3">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                @if(auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('admin.dashboard')" class="px-4 py-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-slate-700">
                    <i class="fas fa-tachometer-alt mr-2 text-indigo-600 dark:text-indigo-400"></i> Admin Dashboard
                </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('profile.edit')" class="px-4 py-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-slate-700">
                    <i class="fas fa-edit mr-2 text-indigo-600 dark:text-indigo-400"></i> Edit Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="px-4 py-3 rounded-lg hover:bg-red-50 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endauth

            @guest
            <div class="px-4 space-y-2 pb-4">
                <!-- Dark Mode Toggle Mobile -->
                <button id="dark-mode-toggle-mobile" class="w-full p-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors flex items-center justify-center" aria-label="Toggle dark mode">
                    <i id="dark-mode-icon-mobile" class="fas fa-moon text-lg mr-2"></i>
                    <span>Toggle Dark Mode</span>
                </button>
                <a href="{{ route('login') }}" class="block text-center text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium px-4 py-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-slate-700 transition">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="block text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition font-semibold">
                    Register
                </a>
            </div>
            @endguest
        </div>
    </div>
</nav>
