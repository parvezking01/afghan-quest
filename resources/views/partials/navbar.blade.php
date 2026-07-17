<nav id="navbar"
    class="fixed top-0 left-0 right-0 z-50 bg-white/70 dark:bg-gray-900/80 backdrop-blur-xl transition-all duration-500 py-3">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            <!-- Logo + Nav Links (Left Side) -->
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-2xl font-black flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Afghan Quest Logo" class="h-16 w-auto">

                    <span
                        class="gradient-text hidden sm:inline">{{ app()->getLocale() === 'en' ? 'Afghan Quest' : 'افغان کویست' }}</span>
                </a>

                <!-- Desktop Menu (only essential links) -->
                <div class="hidden lg:flex items-center gap-5">
                    <a href="{{ url('/') }}"
                        class="font-medium text-sm text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-gold-400 transition-colors">
                        {{ app()->getLocale() === 'en' ? 'Home' : 'صفحه اصلی' }}
                    </a>
                    <a href="{{ route('provinces.index') }}"
                        class="font-medium text-sm text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-gold-400 transition-colors">
                        {{ app()->getLocale() === 'en' ? 'Provinces' : 'ولایات' }}
                    </a>
                    <a href="{{ route('destinations.index') }}"
                        class="font-medium text-sm text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-gold-400 transition-colors">
                        {{ app()->getLocale() === 'en' ? 'Destinations' : 'مکان ها' }}
                    </a>
                    <a href="{{ route('packages.index') }}"
                        class="font-medium text-sm text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-gold-400 transition-colors">
                        {{ app()->getLocale() === 'en' ? 'Tours' : 'پکیج‌ها' }}
                    </a>
                    <a href="{{ route('hotels.index') }}"
                        class="font-medium text-sm text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-gold-400 transition-colors">
                        {{ app()->getLocale() === 'en' ? 'Hotels' : 'هوتل‌ها' }}
                    </a>
                </div>
            </div>

            <!-- Right Side: Search + Tools + Auth -->
            <div class="hidden lg:flex items-center gap-1">
                <!-- Expandable Search -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="text-gray-500 dark:text-gray-300 hover:text-primary-500 transition-colors p-2 text-lg">
                        <i class="fas fa-search"></i>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute left-0 top-full mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-3 border border-gray-200 dark:border-gray-700"
                        x-transition>
                        <form action="{{ route('search') }}" method="GET">
                            <input type="text" name="q"
                                placeholder="{{ app()->getLocale() === 'en' ? 'Search...' : 'جستجو...' }}"
                                class="w-full px-4 py-2 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-white"
                                autofocus>
                        </form>
                    </div>
                </div>

                <!-- Tools Group (Language + Dark Mode) -->
                <div class="flex items-center gap-0">
                    <div
                        class="flex items-center gap-0 border border-gray-200 dark:border-gray-600 rounded-full overflow-hidden">
                        <a href="{{ route('language.switch', 'fa') }}"
                            class="px-2 py-1 text-xs font-bold transition-all {{ app()->getLocale() === 'fa' ? 'bg-primary-500 text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            FA
                        </a>
                        <a href="{{ route('language.switch', 'en') }}"
                            class="px-2 py-1 text-xs font-bold transition-all {{ app()->getLocale() === 'en' ? 'bg-primary-500 text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            EN
                        </a>
                    </div>
                    <button onclick="toggleDarkMode()"
                        class="text-gray-500 dark:text-gray-300 hover:text-yellow-500 transition-colors p-2 text-lg">
                        <i id="darkIcon" class="fas fa-moon text-sm"></i>
                    </button>
                </div>

                <!-- Auth Buttons -->
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="gradient-btn text-white px-4 py-2 rounded-full text-xs font-bold">
                            {{ app()->getLocale() === 'en' ? 'Admin' : 'مدیریت' }}
                        </a>
                    @elseif(auth()->user()->isHotelOwner())
                        <a href="{{ route('hotel_owner.dashboard') }}"
                            class="gradient-btn text-white px-4 py-2 rounded-full text-xs font-bold">
                            {{ app()->getLocale() === 'en' ? 'Hotel Panel' : 'پنل هتل' }}
                        </a>
                    @else
                        <a href="{{ route('tourist.dashboard') }}"
                            class="gradient-btn text-white px-4 py-2 rounded-full text-xs font-bold">
                            {{ app()->getLocale() === 'en' ? 'Dashboard' : 'داشبورد' }}
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-red-500 hover:text-red-700 text-sm p-2 transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="border-2 border-primary-500 text-primary-500 dark:text-primary-400 dark:border-primary-400 px-4 py-2 rounded-full text-xs font-bold hover:bg-primary-500 hover:text-white transition-all">
                        {{ app()->getLocale() === 'en' ? 'Login' : 'ورود' }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="gradient-gold text-primary-900 px-4 py-2 rounded-full text-xs font-bold ml-1">
                        {{ app()->getLocale() === 'en' ? 'Register' : 'ثبت نام' }}
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                class="lg:hidden text-2xl text-gray-700 dark:text-gray-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4">
            <div class="flex flex-col gap-3 bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-2xl">
                <!-- Mobile Search -->
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q"
                            placeholder="{{ app()->getLocale() === 'en' ? 'Search...' : 'جستجو...' }}"
                            class="w-full px-4 py-2 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-white pl-9">
                        <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>

                <!-- Mobile Nav Links -->
                <a href="{{ url('/') }}"
                    class="py-2 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 font-medium dark:text-gray-200 text-sm">{{ app()->getLocale() === 'en' ? 'Home' : 'صفحه اصلی' }}</a>
                <a href="{{ route('provinces.index') }}"
                    class="py-2 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 font-medium dark:text-gray-200 text-sm">{{ app()->getLocale() === 'en' ? 'Provinces' : 'ولایات' }}</a>
                <a href="{{ route('destinations.index') }}"
                    class="py-2 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 font-medium dark:text-gray-200 text-sm">{{ app()->getLocale() === 'en' ? 'Destinations' : 'مکان ها' }}</a>
                <a href="{{ route('packages.index') }}"
                    class="py-2 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 font-medium dark:text-gray-200 text-sm">{{ app()->getLocale() === 'en' ? 'Tours' : 'پکیج ها' }}</a>
                <a href="{{ route('hotels.index') }}"
                    class="py-2 px-4 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 font-medium dark:text-gray-200 text-sm">{{ app()->getLocale() === 'en' ? 'Hotels' : 'هوتل‌ها' }}</a>

                <hr class="dark:border-gray-600">

                <!-- Mobile Language -->
                <div class="flex gap-1 justify-center">
                    <a href="{{ route('language.switch', 'fa') }}"
                        class="px-4 py-1 text-xs font-bold rounded-full {{ app()->getLocale() === 'fa' ? 'bg-primary-500 text-white' : 'bg-gray-100 dark:bg-gray-700' }}">FA</a>
                    <a href="{{ route('language.switch', 'en') }}"
                        class="px-4 py-1 text-xs font-bold rounded-full {{ app()->getLocale() === 'en' ? 'bg-primary-500 text-white' : 'bg-gray-100 dark:bg-gray-700' }}">EN</a>
                </div>

                @auth
                    <a href="{{ route('tourist.dashboard') }}"
                        class="gradient-btn text-white text-center py-2 rounded-xl font-bold text-sm">{{ app()->getLocale() === 'en' ? 'Dashboard' : 'داشبورد' }}</a>
                @else
                    <a href="{{ route('login') }}"
                        class="gradient-btn text-white text-center py-2 rounded-xl font-bold text-sm">{{ app()->getLocale() === 'en' ? 'Login' : 'ورود' }}</a>
                    <a href="{{ route('register') }}"
                        class="gradient-gold text-primary-900 text-center py-2 rounded-xl font-bold text-sm">{{ app()->getLocale() === 'en' ? 'Register' : 'ثبت نام' }}</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Spacer -->
<div class="h-16"></div>

<!-- Alpine.js for search dropdown -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
