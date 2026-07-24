<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'پنل مدیریت') | افغان کویست</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 & Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'dari': ['Vazirmatn', 'Tahoma', 'sans-serif'],
                    },
                    colors: {
                        sidebar: '#0f1923',
                        sidebarHover: '#1a2d3d',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Vazirmatn', Tahoma, sans-serif;
        }

        body {
            background: #f1f5f9;
        }

        .dark body {
            background: #0f172a;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #1e293b;
        }
        ::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        * {
            scrollbar-width: thin;
            scrollbar-color: #475569 #1e293b;
        }

        /* Dark Mode - Main Content Overrides */
        .dark .bg-white { background: #1e293b !important; }
        .dark .bg-gray-100 { background: #0f172a !important; }
        .dark .bg-gray-50 { background: #1a1f2e !important; }
        .dark .text-gray-900 { color: #f1f5f9 !important; }
        .dark .text-gray-800 { color: #e2e8f0 !important; }
        .dark .text-gray-700 { color: #cbd5e1 !important; }
        .dark .text-gray-600 { color: #94a3b8 !important; }
        .dark .text-gray-500 { color: #64748b !important; }
        .dark .text-gray-400 { color: #475569 !important; }
        .dark .border-gray-100, .dark .border-gray-200 { border-color: #334155 !important; }

        .dark input, .dark textarea, .dark select {
            background: #1e293b !important;
            color: #e2e8f0 !important;
            border-color: #475569 !important;
        }
        .dark input::placeholder, .dark textarea::placeholder { color: #64748b !important; }
        .dark .shadow-sm { box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4) !important; }
        .dark .hover\:bg-gray-50:hover { background: #1a1f2e !important; }
        .dark .hover\:bg-gray-100:hover { background: #1e293b !important; }

        .sidebar-link {
            transition: all 0.3s ease;
            color: #94a3b8;
        }
        .sidebar-link:hover {
            background: #1a2d3d;
            color: #F4D03F;
            padding-right: 24px;
        }
        .sidebar-link.active {
            background: #1a2d3d;
            color: #F4D03F;
            border-right: 3px solid #F4D03F;
            font-weight: bold;
        }
    </style>
</head>

<body class="font-dari overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen w-full">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-gray-900/80 z-30 lg:hidden backdrop-blur-sm" style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'"
            class="w-72 flex flex-col fixed inset-y-0 right-0 z-40 shadow-2xl transition-transform duration-300 ease-in-out"
            style="background: #0f1923;">

            <div class="p-6 border-b border-gray-700 flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3 text-2xl font-black">
                    <img src="{{ asset('images/logo.png') }}" alt="Afghan Quest Logo" class="h-12 w-auto">
                    <span style="color: #F4D03F;">افغان کویست</span>
                </a>
                <!-- Close Button (Mobile Only) -->
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <p class="text-gray-400 text-sm mt-3 px-6 mb-2">پنل مدیریت</p>

            <nav class="flex-1 overflow-y-auto py-2 px-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-3">منوی اصلی</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>داشبورد</span>
                </a>

                <a href="{{ route('admin.provinces.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.provinces.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt w-5 text-center"></i>
                    <span>ولایات</span>
                </a>

                <a href="{{ route('admin.destinations.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                    <i class="fas fa-landmark w-5 text-center"></i>
                    <span>مکان ها</span>
                </a>

                <a href="{{ route('admin.hotels.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.hotels.*') ? 'active' : '' }}">
                    <i class="fas fa-hotel w-5 text-center"></i>
                    <span>هوتل‌ها</span>
                </a>

                <a href="{{ route('admin.packages.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                    <i class="fas fa-box w-5 text-center"></i>
                    <span>پکیج‌ها</span>
                </a>

                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 mt-8 px-3">مدیریت</p>

                <a href="{{ route('admin.bookings.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check w-5 text-center"></i>
                    <span>رزروها</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span>کاربران</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                    <i class="fas fa-star w-5 text-center"></i>
                    <span>نظرات</span>
                </a>

                <a href="{{ route('admin.trending.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('admin.trending.*') ? 'active' : '' }}">
                    <i class="fas fa-fire w-5 text-center"></i>
                    <span>پرطرفدارها</span>
                </a>

                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 mt-8 px-3">حساب</p>

                <a href="{{ route('profile.edit') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl mb-1 text-base {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog w-5 text-center"></i>
                    <span>تنظیمات پروفایل</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-700 mx-4 mb-4">
                <div class="flex items-center gap-3 bg-gray-800 rounded-xl p-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-black font-bold text-lg"
                        style="background: #F4D03F;">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">مدیر سیستم</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-gray-400 hover:text-red-400 transition-colors text-lg" title="خروج">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-100 dark:bg-gray-900 transition-colors duration-300 w-full lg:mr-72">

            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-20 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <div class="flex items-center justify-between px-4 lg:px-8 py-4 lg:py-5">
                    <div class="flex items-center gap-4">
                        <!-- Mobile Hamburger Button -->
                        <button @click="sidebarOpen = true" class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-primary-500 text-2xl">
                            <i class="fas fa-bars"></i>
                        </button>

                        <div>
                            <h1 class="text-xl lg:text-2xl font-black text-gray-900 dark:text-white">@yield('page_title', 'داشبورد')</h1>
                            <p class="text-xs lg:text-sm text-gray-500 dark:text-gray-400 mt-1 hidden sm:block">@yield('page_subtitle', 'خوش آمدید ' . auth()->user()->name)</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 lg:gap-3">
                        <button onclick="toggleDarkMode()"
                            class="text-gray-500 dark:text-gray-300 hover:text-yellow-500 transition-colors text-xl p-2"
                            title="حالت شب/روز">
                            <i id="darkIcon" class="fas fa-moon"></i>
                        </button>
                        <a href="{{ url('/') }}"
                            class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-3 lg:px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                            <i class="fas fa-external-link-alt rtl:ml-1 ltr:mr-1"></i>
                            <span class="hidden sm:inline">مشاهده سایت</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-4 lg:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Unified Dark Mode Logic (Matches Frontend)
        document.addEventListener('DOMContentLoaded', () => {
            const isDarkTheme = localStorage.getItem('theme') === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

            if (isDarkTheme) {
                document.documentElement.classList.add('dark');
                updateDarkIcon(true);
            } else {
                document.documentElement.classList.remove('dark');
                updateDarkIcon(false);
            }
        });

        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light'); // Key matched to frontend
            updateDarkIcon(isDark);
        }

        function updateDarkIcon(isDark) {
            const icon = document.getElementById('darkIcon');
            if (icon) {
                if (isDark) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                    icon.classList.add('text-yellow-400');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                    icon.classList.remove('text-yellow-400');
                }
            }
        }

        // Global SweetAlert Delete Form Interceptor
        function confirmDelete(form) {
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "این عملیات قابل بازگشت نیست!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'بله، حذف کن!',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Auto-attach confirmDelete to forms with data-confirm attributes (Optional utility)
        document.querySelectorAll('form[data-confirm="true"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                confirmDelete(this);
            });
        });
    </script>

    <!-- SweetAlert Session Triggers -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'موفقیت‌آمیز!',
                text: '{{ session('success') }}',
                confirmButtonText: 'باشه',
                confirmButtonColor: '#1B5E20',
                timer: 4000,
                timerProgressBar: true
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
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطا در ثبت اطلاعات!',
                html: '<ul class="text-right" style="direction: rtl;">@foreach ($errors->all() as $error)<li class="mb-1">• {{ $error }}</li>@endforeach</ul>',
                confirmButtonText: 'اصلاح می‌کنم',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
</body>
</html>
