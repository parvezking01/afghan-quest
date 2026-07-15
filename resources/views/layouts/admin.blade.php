<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت') | افغان کویست</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet"
        type="text/css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    /* Custom Scrollbar - ALWAYS DARK */
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

    /* Firefox Scrollbar - ALWAYS DARK */
    * {
        scrollbar-width: thin;
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
    .dark input::placeholder,
    .dark textarea::placeholder {
        color: #64748b !important;
    }
    .dark .shadow-sm {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4) !important;
    }
    .dark .hover\:bg-gray-50:hover {
        background: #1a1f2e !important;
    }
    .dark .hover\:bg-gray-100:hover {
        background: #1e293b !important;
    }

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

<body class="font-dari">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-72 flex flex-col fixed h-full z-30 shadow-2xl" style="background: #0f1923;">
            <div class="p-6 border-b border-gray-700">
                <a href="{{ url('/') }}" class="flex items-center gap-3 text-2xl font-black">
                    <span class="text-3xl">🏔️</span>
                    <span style="color: #F4D03F;">افغان کویست</span>
                </a>
                <p class="text-gray-400 text-sm mt-1 mr-2">پنل مدیریت</p>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-4">
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
                    <div class="flex-1">
                        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">مدیر سیستم</p>
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

        <main class="flex-1 mr-72 overflow-y-auto bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
            <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-20 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <div class="flex items-center justify-between px-8 py-5">
                    <div>
                        <h1 class="text-2xl font-black text-gray-900 dark:text-white">@yield('page_title', 'داشبورد')</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@yield('page_subtitle', 'خوش آمدید ' . auth()->user()->name)</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="toggleDarkMode()" class="text-gray-500 dark:text-gray-300 hover:text-yellow-500 transition-colors text-xl p-2" title="حالت شب/روز">
                            <i id="darkIcon" class="fas fa-moon"></i>
                        </button>
                        <a href="{{ url('/') }}"
                            class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-external-link-alt ms-1"></i> مشاهده سایت
                        </a>
                    </div>
                </div>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>

    @if (session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'موفقیت‌آمیز!', text: '{{ session('success') }}', confirmButtonText: 'باشه', confirmButtonColor: '#1B5E20', timer: 4000, timerProgressBar: true });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({ icon: 'error', title: 'خطا!', text: '{{ session('error') }}', confirmButtonText: 'باشه', confirmButtonColor: '#d33' });
    </script>
    @endif

    @if ($errors->any())
    <script>
        Swal.fire({ icon: 'error', title: 'خطا در ثبت اطلاعات!', html: '<ul class="text-right" style="direction: rtl;">@foreach ($errors->all() as $error)<li class="mb-1">• {{ $error }}</li>@endforeach</ul>', confirmButtonText: 'اصلاح می‌کنم', confirmButtonColor: '#d33' });
    </script>
    @endif

    <script>
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
                if (result.isConfirmed) { form.submit(); }
            });
        }

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
