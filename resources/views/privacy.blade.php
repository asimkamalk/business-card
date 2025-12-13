<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Itapp Digital</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('itappdigital_logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('itappdigital_logo.svg') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-white dark:bg-slate-900">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 mb-6">
                    <img src="{{ asset('itappdigital_logo.svg') }}" alt="Logo" class="h-10 w-auto">
                    <span class="text-xl font-heading font-bold" style="background: linear-gradient(135deg, #784587 0%, #9d5ba8 50%, #784587 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Itapp Digital</span>
                </a>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Privacy Policy</h1>
                <p class="text-gray-600 dark:text-gray-400">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="prose prose-lg dark:prose-invert max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">1. Introduction</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        We respect your privacy and are committed to protecting your personal data. This privacy policy explains how we collect, use, and safeguard your information when you use our digital business card platform.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">2. Information We Collect</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">We collect the following types of information:</p>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 mb-4">
                        <li>Personal information (name, email, phone number)</li>
                        <li>Profile information (company, position, bio)</li>
                        <li>Contact information and social media links</li>
                        <li>Usage data and analytics</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">3. How We Use Your Information</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">We use your information to:</p>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 mb-4">
                        <li>Create and manage your digital business card</li>
                        <li>Provide customer support</li>
                        <li>Improve our services</li>
                        <li>Send important updates and notifications</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">4. Data Security</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        We implement appropriate security measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">5. Your Rights</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">You have the right to:</p>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 mb-4">
                        <li>Access your personal data</li>
                        <li>Correct inaccurate data</li>
                        <li>Request deletion of your data</li>
                        <li>Object to processing of your data</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">6. Contact Us</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        If you have questions about this privacy policy, please contact us through our support channels.
                    </p>
                </section>
            </div>

            <div class="mt-8">
                <a href="{{ route('home') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>

