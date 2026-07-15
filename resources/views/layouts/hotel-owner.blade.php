<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مالک هوتل') | افغان کویست</title>

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

        .dark body {
            background: #0f172a;
        }

        /* Custom Scrollbar - Light Mode */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Custom Scrollbar - Dark Mode */
        .dark ::-webkit-scrollbar-track {
            background: #1e293b;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        /* Firefox Scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        .dark * {
            scrollbar-color: #475569 #1e293b;
        }

        /* Dark Mode - Main Content */
        .dark .bg-white {
            background: #1e293b !important;
        }
        .dark .bg-gray-100 {
            background: #0f172a !important;
        }
        .dark .bg-gray-50 {
            background: #1a1f2e !important;
        }
        .dark .text-gray-900 {
            color: #f1f5f9 !important;
        }
        .dark .text-gray-800 {
            color: #e2e8f0 !important;
        }
        .dark .text-gray-700 {
            color: #cbd5e1 !important;
        }
        .dark .text-gray-600 {
            color: #94a3b8 !important;
        }
        .dark .text-gray-500 {
            color: #64748b !important;
        }
        .dark .text-gray-400 {
            color: #475569 !important;
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
        .dark .shadow-sm {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4) !important;
        }

        .sidebar-link {
            transition: all 0.3s ease;
            color: #94a3b8;
            border-radius: 12px;
        }

        .sidebar-link:hover {
            background: #1e293b;
            color: #F4D03F;
            padding-right: 20px;
        }

        .sidebar-link.active {
            background: #1e293b;
            color: #F4D03F;
            border-right: 3px solid #F4D03F;
            font-weight: bold;
        }
    </style>
</head>

<body class="font-dari dark:bg-gray-900 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-72 flex flex-col fixed h-full z-30 shadow-2xl" style="background: #0f1923;">

            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <a href="{{ url('/') }}" class="flex items-center gap-3 text-xl font-black">
                    <span class="text-2xl">🏨</span>
                    <span style="color: #F4D03F;">پنل هوتل</span>
                </a>
                <p class="text-gray-400 text-sm mt-1 mr-2">مدیریت اقامتگاه</p>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 overflow-y-auto py-6 px-4">

                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-3">منوی اصلی</p>

                <a href="{{ route('hotel_owner.dashboard') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 mb-1 text-base {{ request()->routeIs('hotel_owner.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 text-center"></i>
                    <span>داشبورد</span>
                </a>

                <a href="{{ route('hotel_owner.hotels.index') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 mb-1 text-base {{ request()->routeIs('hotel_owner.hotels.*') ? 'active' : '' }}">
                    <i class="fas fa-hotel w-5 text-center"></i>
                    <span>هوتل‌های من</span>
                </a>

                <a href="{{ route('hotel_owner.bookings') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 mb-1 text-base {{ request()->routeIs('hotel_owner.bookings') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check w-5 text-center"></i>
                    <span>رزروها</span>
                </a>

                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 mt-8 px-3">حساب</p>

                <a href="{{ route('profile.edit') }}"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 mb-1 text-base {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog w-5 text-center"></i>
                    <span>تنظیمات پروفایل</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-gray-700 mx-4 mb-4">
                <div class="flex items-center gap-3 bg-gray-800 rounded-xl p-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-black font-bold text-lg"
                        style="background: #F4D03F;">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">مالک هوتل</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-gray-400 hover:text-red-400 transition-colors text-lg">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 mr-72 overflow-y-auto bg-gray-100 dark:bg-gray-900 transition-colors duration-300">

            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-20 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <div class="flex items-center justify-between px-8 py-5">
                    <div>
                        <h1 class="text-2xl font-black text-gray-900 dark:text-white">@yield('page_title', 'داشبورد')</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@yield('page_subtitle', 'خوش آمدید ' . auth()->user()->name)</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <button onclick="toggleDarkMode()" class="text-gray-500 dark:text-gray-300 hover:text-yellow-500 transition-colors text-xl p-2" title="حالت شب/روز">
                            <i id="darkIcon" class="fas fa-moon"></i>
                        </button>

                        <span class="text-sm text-gray-400 dark:text-gray-500">
                            @if (auth()->user()->is_approved)
                                <span class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 px-3 py-1 rounded-lg font-medium">✅ تایید شده</span>
                            @else
                                <span class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 px-3 py-1 rounded-lg font-medium">⏳ در انتظار تایید</span>
                            @endif
                        </span>
                        <a href="{{ url('/') }}"
                            class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-external-link-alt ms-1"></i> مشاهده سایت
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>

    @if (session('success'))
    <script>Swal.fire({ icon: 'success', title: 'موفق!', text: '{{ session('success') }}', confirmButtonText: 'باشه', confirmButtonColor: '#1B5E20' });</script>
    @endif
    @if (session('error'))
    <script>Swal.fire({ icon: 'error', title: 'خطا!', text: '{{ session('error') }}', confirmButtonText: 'باشه', confirmButtonColor: '#d33' });</script>
    @endif
    @if ($errors->any())
    <script>Swal.fire({ icon: 'error', title: 'خطا!', html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>', confirmButtonText: 'باشه' });</script>
    @endif

    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);
            const icon = document.getElementById('darkIcon');
            if (icon) { icon.classList.toggle('fa-moon', !isDark); icon.classList.toggle('fa-sun', isDark); }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const icon = document.getElementById('darkIcon');
            if (icon && document.documentElement.classList.contains('dark')) { icon.classList.replace('fa-moon', 'fa-sun'); }
        });
    </script>
</body>

</html>
