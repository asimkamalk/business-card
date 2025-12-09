<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create your beautiful digital business card in minutes. Professional, customizable business cards that showcase your brand and make connecting effortless.">
    <meta name="keywords" content="digital business card, virtual business card, NFC card, QR code business card, online business card">
    <meta name="author" content="CardPro">
    <meta property="og:title" content="CardPro - Digital Business Card Maker">
    <meta property="og:description" content="Create your beautiful digital business card in minutes. Professional, customizable business cards.">
    <meta property="og:type" content="website">
    <title>CardPro - Create Your Digital Business Card in Minutes</title>

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
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-in-left': 'slideInLeft 0.6s ease-out',
                        'slide-in-right': 'slideInRight 0.6s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
            background-color: #ffffff;
        }

        .dark body {
            background-color: #0f172a;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #f7fafc;
            transform: translateY(-2px);
        }

        .nav-blur {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .dark .nav-blur {
            background: rgba(15, 23, 42, 0.8);
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .pattern-dots {
            background-image: radial-gradient(circle, rgba(102, 126, 234, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .card-preview {
            perspective: 1000px;
        }

        .card-preview-inner {
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .card-preview:hover .card-preview-inner {
            transform: rotateY(5deg) rotateX(5deg);
        }
    </style>
</head>

<body class="bg-white dark:bg-slate-900">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 nav-blur shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-id-card text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-heading font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">CardPro</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#features" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Features</a>
                    <a href="#how-it-works" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">How It Works</a>
                    @if($products->count() > 0)
                    <a href="#products" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Products</a>
                    @endif
                    <a href="#testimonials" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Testimonials</a>
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
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-slate-800 border-t dark:border-gray-700">
            <div class="px-4 py-4 space-y-3">
                <a href="#features" class="block text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium py-2">Features</a>
                <a href="#how-it-works" class="block text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium py-2">How It Works</a>
                @if($products->count() > 0)
                <a href="#products" class="block text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium py-2">Products</a>
                @endif
                <a href="#testimonials" class="block text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium py-2">Testimonials</a>
                <a href="{{ route('login') }}" class="block text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium py-2">Login</a>
                <a href="{{ route('register') }}" class="block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-lg font-semibold text-center">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-32 pb-20 md:pt-40 md:pb-32 relative overflow-hidden">
        <div class="absolute inset-0 pattern-dots opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left animate-on-scroll">
                    <div class="inline-block mb-4 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                        <i class="fas fa-sparkles mr-2"></i> Trusted by 10,000+ Professionals
                    </div>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-heading font-bold leading-tight mb-6">
                        Create Your <span class="text-yellow-300">Digital</span> Business Card
                    </h1>
                    <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                        Professional, customizable business cards that showcase your brand and make connecting effortless. Share your card anywhere, anytime.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center justify-center shadow-xl">
                            <i class="fas fa-rocket mr-2"></i> Get Started Free
                        </a>
                        <a href="#how-it-works" class="btn-secondary px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center justify-center">
                            <i class="fas fa-play-circle mr-2"></i> See How It Works
                        </a>
                    </div>
                    <div class="mt-8 flex flex-wrap gap-6 justify-center md:justify-start text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>No Credit Card Required</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Free Forever Plan</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-300 mr-2"></i>
                            <span>Setup in 5 Minutes</span>
                        </div>
                    </div>
                </div>
                <div class="relative animate-on-scroll">
                    <div class="card-preview">
                        <div class="card-preview-inner">
                            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden floating">
                                <div class="h-48 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative">
                                    <div class="absolute inset-0 bg-black/20"></div>
                                </div>
                                <div class="relative -mt-16 px-6 pb-8">
                                    <div class="flex justify-center mb-4">
                                        <div class="w-32 h-32 rounded-full border-4 border-white dark:border-slate-800 overflow-hidden shadow-xl">
                                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop" class="w-full h-full object-cover" alt="Profile">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Alex Morgan</h3>
                                        <p class="text-indigo-600 dark:text-indigo-400 font-semibold mb-3">Digital Marketing Specialist</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-6">Helping businesses grow their online presence</p>
                                        <div class="flex justify-center space-x-3 mb-4">
                                            <a href="#" class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-600 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-800 transition">
                                                <i class="fab fa-linkedin text-sm"></i>
                                            </a>
                                            <a href="#" class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                                <i class="fab fa-twitter text-sm"></i>
                                            </a>
                                            <a href="#" class="w-10 h-10 rounded-full bg-pink-100 dark:bg-pink-900 flex items-center justify-center text-pink-600 dark:text-pink-300 hover:bg-pink-200 dark:hover:bg-pink-800 transition">
                                                <i class="fab fa-instagram text-sm"></i>
                                            </a>
                                        </div>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-center justify-center text-gray-700 dark:text-gray-300">
                                                <i class="fas fa-phone text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                                <span>+1 (555) 123-4567</span>
                                            </div>
                                            <div class="flex items-center justify-center text-gray-700 dark:text-gray-300">
                                                <i class="fas fa-envelope text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                                <span>alex@example.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-b from-transparent to-white dark:to-slate-900"></div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="stat-card text-center">
                    <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">10K+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">Active Users</div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">50K+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">Cards Created</div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">1M+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">Connections Made</div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">4.9/5</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">User Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50 dark:bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
                    Everything You Need to <span class="gradient-text">Stand Out</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Powerful features designed to help you create, share, and track your digital business card effortlessly
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-palette text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Beautiful Templates</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Choose from dozens of professionally designed templates. Customize colors, fonts, and layouts to match your brand perfectly.
                    </p>
                    <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="feature-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-qrcode text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">QR Code & NFC</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Generate unique QR codes and NFC tags. Share your card instantly with a simple scan or tap. Perfect for networking events.
                    </p>
                    <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="feature-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-share-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Easy Sharing</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Share via link, QR code, email, or social media. Your card works on any device - no app download required for viewers.
                    </p>
                    <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="feature-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Analytics Dashboard</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Track views, clicks, and engagement. See who's viewing your card and which links they're clicking. Make data-driven decisions.
                    </p>
                    <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="feature-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Mobile Optimized</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Your card looks perfect on any device. Responsive design ensures a great experience whether viewed on phone, tablet, or desktop.
                    </p>
                    <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="feature-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-lock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Secure & Private</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Your data is encrypted and secure. Control who can view your card and what information they see. Privacy is our priority.
                    </p>
                    <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
                    How It <span class="gradient-text">Works</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Get started in minutes. It's that simple.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center animate-on-scroll">
                    <div class="relative mb-8">
                        <div class="step-number w-20 h-20 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto shadow-lg">
                            1
                        </div>
                        <div class="absolute top-10 left-1/2 w-full h-0.5 bg-gradient-to-r from-indigo-500 to-purple-500 hidden md:block"></div>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Sign Up Free</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Create your account in seconds. No credit card required. Start with our free plan and upgrade anytime.
                    </p>
                </div>

                <div class="text-center animate-on-scroll">
                    <div class="relative mb-8">
                        <div class="step-number w-20 h-20 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto shadow-lg">
                            2
                        </div>
                        <div class="absolute top-10 left-1/2 w-full h-0.5 bg-gradient-to-r from-purple-500 to-pink-500 hidden md:block"></div>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Customize Your Card</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Choose a template, add your information, upload photos, and customize colors. Make it uniquely yours in minutes.
                    </p>
                </div>

                <div class="text-center animate-on-scroll">
                    <div class="relative mb-8">
                        <div class="step-number w-20 h-20 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto shadow-lg">
                            3
                        </div>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4">Share & Connect</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Share your card via QR code, link, or social media. Start making connections and growing your network today.
                    </p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center shadow-xl">
                    <i class="fas fa-rocket mr-2"></i> Get Started Now
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-slate-800 dark:via-slate-800 dark:to-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
                    Loved by <span class="gradient-text">Thousands</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    See what our users are saying about CardPro
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="testimonial-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" class="w-full h-full object-cover" alt="Sarah">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Sarah Johnson</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Marketing Director</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        "CardPro has completely transformed how I network. The QR code feature is a game-changer at events. I've made more meaningful connections in the past month than in the previous year!"
                    </p>
                </div>

                <div class="testimonial-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" class="w-full h-full object-cover" alt="Michael">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Michael Chen</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Business Consultant</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        "The analytics feature is incredible. I can see exactly who's viewing my card and which links they click. This data has helped me refine my networking strategy significantly."
                    </p>
                </div>

                <div class="testimonial-card bg-white dark:bg-slate-700 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop" class="w-full h-full object-cover" alt="Emily">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Emily Rodriguez</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Freelance Designer</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        "As a freelancer, having a professional digital card has been essential. The templates are beautiful and the customization options are endless. My clients are always impressed!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    @if($products->count() > 0)
    <section id="products" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
                    Featured <span class="gradient-text">Products</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Discover amazing products and services from our community
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <!-- Product Image -->
                        <div class="relative h-64 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 overflow-hidden">
                            @if($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-indigo-300 dark:text-indigo-600 text-5xl"></i>
                                </div>
                            @endif
                            @if($product->featured)
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            
                            @if($product->description)
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between mb-4">
                                @if($product->price)
                                    <span class="text-3xl font-bold gradient-text">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-lg text-gray-500 dark:text-gray-400">Contact for pricing</span>
                                @endif
                            </div>
                            
                            <!-- Product Owner -->
                            <div class="flex items-center mb-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                @if($product->profile->profile_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->profile->profile_image))
                                    <img src="{{ asset('storage/' . $product->profile->profile_image) }}" 
                                         alt="{{ $product->profile->user->name }}"
                                         class="w-10 h-10 rounded-full border-2 border-white dark:border-slate-800 shadow-md mr-3">
                                @else
                                    <div class="w-10 h-10 rounded-full border-2 border-white dark:border-slate-800 shadow-md bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->profile->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $product->profile->position ?? 'Business Owner' }}</p>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex gap-3">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-3 rounded-xl font-semibold text-center hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-eye mr-2"></i> View Details
                                </a>
                                <a href="{{ route('public.profile', $product->profile->user->username) }}"
                                   class="px-4 py-3 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-200 dark:hover:bg-slate-600 transition">
                                    <i class="fas fa-user"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if(auth()->check())
                <div class="text-center mt-12">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-box mr-2"></i> Manage My Products
                    </a>
                </div>
            @else
                <div class="text-center mt-12">
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-rocket mr-2"></i> Start Selling Your Products
                    </a>
                </div>
            @endif
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 pattern-dots opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-heading font-bold mb-6">
                Ready to Create Your Stunning Digital Business Card?
            </h2>
            <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
                Join thousands of professionals who are making connections effortlessly with CardPro. Get started in minutes, no credit card required.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-indigo-700 hover:bg-gray-100 px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center justify-center shadow-xl transition-all duration-300">
                    <i class="fas fa-rocket mr-2"></i> Get Started for Free
                </a>
                <a href="#features" class="bg-white/10 backdrop-blur-sm text-white hover:bg-white/20 px-8 py-4 rounded-xl font-bold text-lg inline-flex items-center justify-center border-2 border-white/30 transition-all duration-300">
                    <i class="fas fa-info-circle mr-2"></i> Learn More
                </a>
            </div>
            <div class="mt-8 text-sm opacity-80">
                <i class="fas fa-shield-alt mr-2"></i> Free forever plan available • No credit card required • Cancel anytime
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-id-card text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-heading font-bold text-white">CardPro</span>
                    </div>
                    <p class="mb-6 leading-relaxed">
                        Create beautiful digital business cards that leave a lasting impression. Connect effortlessly with professionals worldwide.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-indigo-600 flex items-center justify-center transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-indigo-600 flex items-center justify-center transition">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-indigo-600 flex items-center justify-center transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-indigo-600 flex items-center justify-center transition">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Product</h3>
                    <ul class="space-y-3">
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                        <li><a href="#" class="hover:text-white transition">Templates</a></li>
                        <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition">Integrations</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Press Kit</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Support</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition">Tutorials</a></li>
                        <li><a href="#" class="hover:text-white transition">API Docs</a></li>
                        <li><a href="#" class="hover:text-white transition">Status</a></li>
                    </ul>
                </div>
            </div>

            <div class="section-divider mb-8"></div>

            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="mb-4 md:mb-0">&copy; {{ date('Y') }} CardPro. All rights reserved.</p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                    <a href="#" class="hover:text-white transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Dark mode functionality
        (function() {
            // Check for saved theme preference or default to dark
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
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

            // Add event listeners to both toggle buttons
            document.getElementById('dark-mode-toggle')?.addEventListener('click', toggleDarkMode);
            document.getElementById('dark-mode-toggle-mobile')?.addEventListener('click', toggleDarkMode);
        })();

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.length > 1) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offsetTop = target.offsetTop - 80;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                        // Close mobile menu if open
                        document.getElementById('mobile-menu')?.classList.add('hidden');
                    }
                }
            });
        });

        // Animate on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Navbar background on scroll
        let lastScroll = 0;
        const navbar = document.querySelector('nav');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
            
            lastScroll = currentScroll;
        });
    </script>
</body>

</html>

