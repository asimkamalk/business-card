<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Itapp Digital</title>
    
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
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Terms of Service</h1>
                <p class="text-gray-600 dark:text-gray-400">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="prose prose-lg dark:prose-invert max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">1. Acceptance of Terms</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        By accessing and using our digital business card platform, you accept and agree to be bound by the terms and provision of this agreement.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">2. Use License</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        Permission is granted to temporarily use our platform for personal and commercial purposes. This license does not include:
                    </p>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 mb-4">
                        <li>Modifying or copying the platform</li>
                        <li>Using the platform for any commercial purpose without permission</li>
                        <li>Attempting to reverse engineer any software</li>
                        <li>Removing any copyright or proprietary notations</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">3. User Accounts</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">4. Prohibited Uses</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">You may not use our platform:</p>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 mb-4">
                        <li>In any way that violates applicable laws or regulations</li>
                        <li>To transmit any malicious code or viruses</li>
                        <li>To impersonate or misrepresent your affiliation with any entity</li>
                        <li>To collect or store personal data about other users</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">5. Content Ownership</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        You retain ownership of all content you upload to our platform. By uploading content, you grant us a license to use, display, and distribute your content as necessary to provide our services.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">6. Limitation of Liability</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        We shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our platform.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">7. Changes to Terms</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        We reserve the right to modify these terms at any time. Your continued use of the platform after changes constitutes acceptance of the new terms.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">8. Contact Information</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        If you have any questions about these Terms of Service, please contact us through our support channels.
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

