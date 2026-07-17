<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth" id="htmlRoot">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست') | {{ app()->getLocale() === 'en' ? 'Explore Afghanistan' : 'کاوش در افغانستان' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', app()->getLocale() === 'en' ? 'Afghan Quest - Discover the beauty of Afghanistan. Explore provinces, destinations, hotels, and tour packages.' : 'افغان کویست - کشف زیبایی‌های افغانستان. کاوش در ولایات، مکان ها، هوتل‌ها و پکیج‌های تور.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Afghanistan, tourism, travel, provinces, hotels, tours, افغانستان, گردشگری, سفر, ولایات, هوتل, تور')">
    <meta name="author" content="Afghan Quest">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست')">
    <meta property="og:description" content="@yield('meta_description', app()->getLocale() === 'en' ? 'Discover the beauty of Afghanistan' : 'کشف زیبایی‌های افغانستان')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست')">
    <meta name="twitter:description" content="@yield('meta_description', app()->getLocale() === 'en' ? 'Discover the beauty of Afghanistan' : 'کشف زیبایی‌های افغانستان')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    <!-- Language -->
    <meta name="language" content="{{ app()->getLocale() === 'en' ? 'English' : 'Dari' }}">
    <link rel="alternate" hreflang="fa" href="{{ url()->current() }}?lang=fa">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vazirmatn Persian Font -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet"
        type="text/css" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'dari': ['Vazirmatn', 'Tahoma', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#e8f5e9',
                            100: '#c8e6c9',
                            500: '#1B5E20',
                            600: '#2E7D32',
                            700: '#0D3B0F',
                            800: '#1a1a2e',
                            900: '#16213e',
                        },
                        gold: {
                            400: '#F4D03F',
                            500: '#D4A853',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delay': 'float 8s ease-in-out 2s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
        }

        /* Smooth transitions for dark mode */
        body,
        .bg-white,
        .bg-gray-50,
        .bg-gray-100,
        .text-gray-800,
        .text-gray-700,
        .text-gray-600,
        .text-gray-500,
        .text-gray-400,
        .border-gray-100,
        .border-gray-200,
        .border-gray-300,
        input,
        textarea,
        select {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Dark Mode - Backgrounds */
        .dark .bg-white {
            background: #1e293b !important;
        }

        .dark .bg-gray-50 {
            background: #0f172a !important;
        }

        .dark .bg-gray-100 {
            background: #1a1f2e !important;
        }

        /* Dark Mode - Text Colors (Brighter for visibility) */
        .dark .text-gray-900 {
            color: #f8fafc !important;
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

        /* Dark Mode - Section Titles */
        .dark h2,
        .dark h3,
        .dark h4,
        .dark h5,
        .dark .section-title h2,
        .dark .font-black {
            color: #f1f5f9 !important;
        }

        .dark .section-title p {
            color: #94a3b8 !important;
        }

        /* Dark Mode - Badges */
        .dark .bg-primary-50 {
            background: rgba(27, 94, 32, 0.3) !important;
            color: #4ade80 !important;
        }

        .dark .bg-gold-50 {
            background: rgba(212, 168, 83, 0.2) !important;
            color: #fbbf24 !important;
        }

        /* Dark Mode - Text Accent Colors */
        .dark .text-primary-800 {
            color: #e2e8f0 !important;
        }

        .dark .text-primary-500 {
            color: #4ade80 !important;
        }

        .dark .text-gold-500 {
            color: #f59e0b !important;
        }

        .dark .text-gold-400 {
            color: #fbbf24 !important;
        }

        .dark .text-yellow-400 {
            color: #fbbf24 !important;
        }

        /* Dark Mode - Why Choose Us Cards */
        .dark .card-3d h5 {
            color: #f1f5f9 !important;
        }

        .dark .card-3d p {
            color: #94a3b8 !important;
        }

        /* Dark Mode - Borders */
        .dark .border-gray-100 {
            border-color: #334155 !important;
        }

        .dark .border-gray-200 {
            border-color: #334155 !important;
        }

        .dark .border-gray-300 {
            border-color: #475569 !important;
        }

        /* Dark Mode - Shadows */
        .dark .shadow-sm {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4) !important;
        }

        .dark .shadow-lg {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.5) !important;
        }

        .dark .shadow-2xl {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6) !important;
        }

        /* Dark Mode - Inputs */
        .dark input[type="text"],
        .dark input[type="email"],
        .dark input[type="password"],
        .dark input[type="number"],
        .dark input[type="date"],
        .dark input[type="time"],
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

        /* Dark Mode - Hover states */
        .dark .hover\:bg-gray-50:hover {
            background: #1a1f2e !important;
        }

        .dark .hover\:bg-gray-100:hover {
            background: #1e293b !important;
        }

        /* Dark Mode - Navbar */
        .dark #navbar {
            background: rgba(15, 23, 42, 0.9) !important;
        }

        /* Dark Mode - Footer */
        .dark footer {
            background: #0f172a !important;
        }

        /* Dark Mode - Mobile Menu */
        .dark .mobile-menu {
            background: #1e293b !important;
        }

        /* Glass Effects */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-white {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass-white {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-dark {
            background: rgba(26, 26, 46, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gradient-text {
            background: linear-gradient(to left, #1B5E20, #D4A853);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }

        .gradient-btn {
            background: linear-gradient(135deg, #1B5E20, #2E7D32);
            transition: all 0.3s ease;
        }

        .gradient-btn:hover {
            background: linear-gradient(135deg, #2E7D32, #1B5E20);
            box-shadow: 0 10px 30px rgba(27, 94, 32, 0.3);
            transform: translateY(-2px);
        }

        .gradient-gold {
            background: linear-gradient(135deg, #D4A853, #F4D03F);
            transition: all 0.3s ease;
        }

        .gradient-gold:hover {
            box-shadow: 0 10px 30px rgba(212, 168, 83, 0.3);
            transform: translateY(-2px);
        }

        .card-3d {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-3d:hover {
            transform: translateY(-15px) rotateX(5deg);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .dark .card-3d:hover {
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
        }

        .hero-pattern {
            background-image: radial-gradient(circle at 20% 50%, rgba(27, 94, 32, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(212, 168, 83, 0.1) 0%, transparent 50%);
        }

        .section-divider {
            width: 100px;
            height: 4px;
            background: linear-gradient(to left, #1B5E20, #D4A853);
            border-radius: 2px;
            margin: 20px auto;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 font-dari transition-colors duration-300">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        gsap.registerPlugin(ScrollTrigger);

        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && entry.target.classList.contains('counter')) {
                    animateCounter(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });
        document.querySelectorAll('.counter').forEach(el => observer.observe(el));

        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-white/95', 'shadow-lg');
                    navbar.classList.remove('bg-white/70');
                } else {
                    navbar.classList.remove('bg-white/95', 'shadow-lg');
                    navbar.classList.add('bg-white/70');
                }
            }
        });
    </script>

    <!-- SweetAlert Messages -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'موفقیت‌آمیز!',
                text: '{{ session('success') }}',
                confirmButtonText: 'باشه',
                confirmButtonColor: '#1B5E20',
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطا!',
                text: '{{ session('error') }}',
                confirmButtonText: 'باشه',
                confirmButtonColor: '#d33',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطا!',
                html: '<ul class="text-right">@foreach ($errors->all() as $error)<li class="mb-1">• {{ $error }}</li>@endforeach</ul>',
                confirmButtonText: 'باشه',
                confirmButtonColor: '#d33',
            });
        </script>
    @endif

    @stack('scripts')

    <!-- Dark Mode Script -->
    <script>
        // Check saved dark mode preference
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
                if (isDark) {
                    icon.classList.replace('fa-moon', 'fa-sun');
                } else {
                    icon.classList.replace('fa-sun', 'fa-moon');
                }
            }
        }

        // Set initial icon on page load
        document.addEventListener('DOMContentLoaded', () => {
            const icon = document.getElementById('darkIcon');
            if (icon && document.documentElement.classList.contains('dark')) {
                icon.classList.replace('fa-moon', 'fa-sun');
            }
        });
    </script>
</body>

</html>
