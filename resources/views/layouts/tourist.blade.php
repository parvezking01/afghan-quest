<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'en' ? 'en' : 'fa' }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}"
    class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', app()->getLocale() === 'en' ? 'Tourist Dashboard' : 'داشبورد گردشگر') | {{ app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet"
        type="text/css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'dari': ['Vazirmatn', 'Tahoma', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
        }

        body {
            background: #f8fafc;
        }

        /* Dark Mode */
        .dark body {
            background: #0f172a;
        }

        .dark .bg-white {
            background: #1e293b !important;
        }

        .dark .bg-gray-50 {
            background: #0f172a !important;
        }

        .dark .text-gray-800 {
            color: #f1f5f9 !important;
        }

        .dark .text-gray-700 {
            color: #e2e8f0 !important;
        }

        .dark .text-gray-600 {
            color: #cbd5e1 !important;
        }

        .dark .text-gray-500 {
            color: #94a3b8 !important;
        }

        .dark .text-gray-400 {
            color: #64748b !important;
        }

        .dark .border-gray-100 {
            border-color: #334155 !important;
        }

        .dark .border-gray-200 {
            border-color: #334155 !important;
        }

        .dark input,
        .dark textarea,
        .dark select {
            background: #1e293b !important;
            color: #e2e8f0 !important;
            border-color: #475569 !important;
        }

        .dark input::placeholder,
        .dark textarea::placeholder {
            color: #64748b !important;
        }

        /* Navbar Dark Mode */
        .dark nav {
            background: #1e293b !important;
            border-color: #334155 !important;
        }

        .dark nav .text-gray-800 {
            color: #f1f5f9 !important;
        }

        .dark nav .text-gray-500 {
            color: #94a3b8 !important;
        }

        .dark nav .text-gray-600 {
            color: #cbd5e1 !important;
        }
    </style>
</head>

<body class="font-dari dark:bg-gray-900 transition-colors duration-300">

    <!-- Top Navbar -->
    <nav
        class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30 transition-colors duration-300">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-black">
                    <img src="{{ asset('images/logo.png') }}" alt="Afghan Quest Logo" class="h-16 w-auto">

                    <span
                        class="text-gray-800 dark:text-white">{{ app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست' }}</span>
                </a>

                <!-- Navigation -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('tourist.dashboard') }}"
                        class="text-sm font-bold pb-1 border-b-2 transition-colors {{ request()->routeIs('tourist.dashboard') ? 'text-blue-600 dark:text-blue-400 border-blue-600 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 border-transparent hover:text-gray-700 dark:hover:text-gray-300' }}">
                        {{ app()->getLocale() === 'en' ? 'Dashboard' : 'داشبورد' }}
                    </a>
                    <a href="{{ route('tourist.bookings') }}"
                        class="text-sm font-bold pb-1 border-b-2 transition-colors {{ request()->routeIs('tourist.bookings') ? 'text-blue-600 dark:text-blue-400 border-blue-600 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 border-transparent hover:text-gray-700 dark:hover:text-gray-300' }}">
                        {{ app()->getLocale() === 'en' ? 'My Bookings' : 'رزروهای من' }}
                    </a>
                    <a href="{{ route('tourist.profile') }}"
                        class="text-sm font-bold pb-1 border-b-2 transition-colors {{ request()->routeIs('tourist.profile') ? 'text-blue-600 dark:text-blue-400 border-blue-600 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 border-transparent hover:text-gray-700 dark:hover:text-gray-300' }}">
                        {{ app()->getLocale() === 'en' ? 'Profile' : 'پروفایل' }}
                    </a>
                    <a href="{{ route('provinces.index') }}"
                        class="text-sm font-bold pb-1 border-b-2 transition-colors {{ request()->routeIs('provinces.*') ? 'text-blue-600 dark:text-blue-400 border-blue-600 dark:border-blue-400' : 'text-gray-500 dark:text-gray-400 border-transparent hover:text-gray-700 dark:hover:text-gray-300' }}">
                        {{ app()->getLocale() === 'en' ? 'Explore' : 'کشف مکان ها' }}
                    </a>
                </div>

                <!-- Language Switcher + User Menu + Dark Mode Toggle -->
                <div class="flex items-center gap-3">
                    <!-- Language Switcher -->
                    <div
                        class="flex items-center gap-1 border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 rounded-full overflow-hidden">
                        <a href="{{ route('language.switch', 'fa') }}"
                            class="px-2 py-1 text-xs font-bold transition-all {{ app()->getLocale() === 'fa' ? 'bg-primary-500 dark:bg-primary-700 text-white' : 'text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                            FA
                        </a>
                        <a href="{{ route('language.switch', 'en') }}"
                            class="px-2 py-1 text-xs font-bold transition-all {{ app()->getLocale() === 'en' ? 'bg-primary-500 dark:bg-primary-700 text-white' : 'text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                            EN
                        </a>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()"
                        class="text-gray-500 dark:text-gray-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors text-xl p-2"
                        title="حالت شب/روز">
                        <i id="darkIcon" class="fas fa-moon"></i>
                    </button>

                    <span
                        class="text-sm text-gray-600 dark:text-gray-300 hidden md:block">{{ auth()->user()->name }}</span>
                    <div
                        class="w-9 h-9 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div
                class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl mb-6">
                ✅ {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ app()->getLocale() === 'en' ? 'Success!' : 'موفق!' }}',
                text: '{{ session('success') }}',
                confirmButtonText: '{{ app()->getLocale() === 'en' ? 'OK' : 'باشه' }}',
                confirmButtonColor: '#1B5E20',
                timer: 3000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ app()->getLocale() === 'en' ? 'Error!' : 'خطا!' }}',
                text: '{{ session('error') }}',
                confirmButtonText: '{{ app()->getLocale() === 'en' ? 'OK' : 'باشه' }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ app()->getLocale() === 'en' ? 'Error!' : 'خطا!' }}',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                confirmButtonText: '{{ app()->getLocale() === 'en' ? 'OK' : 'باشه' }}'
            });
        </script>
    @endif

    <script>
        // Dark Mode
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }

        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);

            const icon = document.getElementById('darkIcon');
            if (icon) {
                icon.classList.toggle('fa-moon', !isDark);
                icon.classList.toggle('fa-sun', isDark);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const icon = document.getElementById('darkIcon');
            if (icon && document.documentElement.classList.contains('dark')) {
                icon.classList.replace('fa-moon', 'fa-sun');
            }
        });
    </script>
</body>

</html>
