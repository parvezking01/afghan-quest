@extends('layouts.app')

@section('title', 'صفحه اصلی')

@section('content')

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center relative overflow-hidden"
        style="background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(22, 33, 62, 0.9)), url('{{ asset('images/KABUL.jpg') }}') center/cover no-repeat;">

        <!-- Animated circles (Updated with start/end for RTL support) -->
        <div class="absolute top-20 end-10 w-96 h-96 bg-primary-500/20 rounded-full animate-float"></div>
        <div class="absolute bottom-20 start-10 w-72 h-72 bg-gold-500/20 rounded-full animate-float-delay"></div>
        <div class="absolute top-1/2 start-1/2 w-48 h-48 bg-white/5 rounded-full animate-pulse-slow -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 50px 50px;"></div>

        <div class="container mx-auto px-4 relative z-10 py-24 lg:py-0">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up">
                    <h1 class="text-4xl lg:text-6xl font-black text-white mb-6 leading-tight">
                        {{ app()->getLocale() === 'en' ? 'Discover the Beautiful' : 'افغانستان زیبا را' }}
                        <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-l from-gold-400 via-white to-gold-400">
                            {{ app()->getLocale() === 'en' ? 'Afghanistan' : 'کشف کنید' }}
                        </span>
                    </h1>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        {{ app()->getLocale() === 'en' ? 'Travel to the most amazing historical and natural destinations of Afghanistan with the best tourism services' : 'سفر به شگفت‌انگیزترین مکان های تاریخی و طبیعی افغانستان با بهترین خدمات گردشگری' }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('packages.index') }}"
                            class="gradient-gold text-primary-900 px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl hover:shadow-gold-500/30 transition-all inline-block transform hover:-translate-y-1">
                            <i class="fas fa-suitcase ms-2"></i>
                            {{ app()->getLocale() === 'en' ? 'View Tours' : 'مشاهده پکیج ها' }}
                        </a>
                        <a href="{{ route('provinces.index') }}"
                            class="border-2 border-white/50 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary-900 transition-all inline-block backdrop-blur-sm">
                            <i class="fas fa-compass ms-2"></i>
                            {{ app()->getLocale() === 'en' ? 'Explore Destinations' : 'کشف مکان ها' }}
                        </a>
                    </div>

                    <!-- Stats (Fixed for Mobile & RTL) -->
                    <div class="mt-12 bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 inline-block w-full sm:w-auto">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 divide-x rtl:divide-x-reverse divide-white/20">
                            <div class="text-center px-4">
                                <div class="text-4xl font-black text-gold-400 counter" data-target="{{ $provincesCount }}">0</div>
                                <div class="text-gray-300 text-sm mt-1">{{ app()->getLocale() === 'en' ? 'Provinces' : 'ولایت' }}</div>
                            </div>
                            <div class="text-center px-4">
                                <div class="text-4xl font-black text-gold-400 counter" data-target="{{ $destinationsCount }}">0</div>
                                <div class="text-gray-300 text-sm mt-1">{{ app()->getLocale() === 'en' ? 'Destinations' : 'مکان' }}</div>
                            </div>
                            <div class="text-center px-4">
                                <div class="text-4xl font-black text-gold-400 counter" data-target="{{ $hotelsCount }}">0</div>
                                <div class="text-gray-300 text-sm mt-1">{{ app()->getLocale() === 'en' ? 'Hotels' : 'هوتل' }}</div>
                            </div>
                            <div class="text-center px-4">
                                <div class="text-4xl font-black text-gold-400 counter" data-target="{{ $packagesCount }}">0</div>
                                <div class="text-gray-300 text-sm mt-1">{{ app()->getLocale() === 'en' ? 'Tours' : 'پکیج' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image grid -->
                <div class="hidden lg:block" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-gold-500/30 to-primary-500/30 rounded-3xl blur-2xl"></div>
                        <div class="relative grid grid-cols-2 gap-3">
                            <img src="{{ asset('images/BANDI_AMIR.jpg') }}" alt="Band-e-Amir" class="rounded-2xl shadow-2xl animate-float w-full h-48 object-cover">
                            <img src="{{ asset('images/ghor.jpg') }}" alt="Minaret of Jam" class="rounded-2xl shadow-2xl animate-float-delay w-full h-48 object-cover mt-8">
                            <img src="{{ asset('images/mazar.jpg') }}" alt="Blue Mosque" class="rounded-2xl shadow-2xl animate-float w-full h-48 object-cover">
                            <img src="{{ asset('images/noristan.jpg') }}" alt="Nuristan" class="rounded-2xl shadow-2xl animate-float-delay w-full h-48 object-cover mt-8">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 start-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
            <span class="text-gray-400 text-sm">{{ app()->getLocale() === 'en' ? 'Scroll down' : 'اسکرول کنید' }}</span>
            <i class="fas fa-chevron-down text-white text-xl opacity-70"></i>
        </div>
    </section>

    <!-- Trending Provinces -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-primary-500 font-bold text-sm bg-primary-50 dark:bg-primary-900/30 px-4 py-2 rounded-full inline-block mb-4">
                    {{ app()->getLocale() === 'en' ? 'Popular Destinations' : 'مکان ها محبوب' }}
                </span>
                <h2 class="text-4xl lg:text-5xl font-black text-primary-800 dark:text-white mb-4">
                    {{ app()->getLocale() === 'en' ? 'Trending Provinces' : 'ولایات پرطرفدار' }}
                </h2>
                <div class="section-divider mx-auto"></div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    {{ app()->getLocale() === 'en' ? 'Most popular tourist destinations in Afghanistan' : 'محبوب‌ترین مکان ها گردشگری افغانستان' }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($trendingProvinces as $province)
                    <div class="group card-3d bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ $province->featured_image ? asset('storage/' . $province->featured_image) : asset('images/default.jpg') }}" alt="{{ locale_field($province, 'name') }}" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <!-- Fixed top-start for RTL -->
                            <div class="absolute top-4 start-4 gradient-btn text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg">
                                {{ locale_field($province, 'name') }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-primary-500 mb-3">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="text-sm font-bold">{{ locale_field($province, 'name') }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                {{ Str::limit(locale_field($province, 'description'), 120) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-1 text-gold-500">
                                    <i class="fas fa-star"></i>
                                    <span class="font-bold">{{ number_format($province->averageRating(), 1) }}</span>
                                    <span class="text-gray-400 text-sm">({{ $province->reviewsCount() }})</span>
                                </div>
                                <a href="{{ route('provinces.show', $province->slug) }}" class="inline-flex items-center gap-2 text-primary-500 font-bold group/link">
                                    {{ app()->getLocale() === 'en' ? 'View' : 'مشاهده' }}
                                    <i class="fas fa-arrow-left text-sm rtl:rotate-180 group-hover/link:-translate-x-1 rtl:group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('provinces.index') }}" class="inline-flex items-center gap-2 text-primary-500 font-bold text-lg hover:gap-3 transition-all border-2 border-primary-500 px-8 py-3 rounded-full hover:bg-primary-500 hover:text-white">
                    {{ app()->getLocale() === 'en' ? 'View All Provinces' : 'مشاهده همه ولایات' }}
                    <i class="fas fa-arrow-left rtl:rotate-180"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Trending Destinations -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-primary-500 font-bold text-sm bg-primary-50 dark:bg-primary-900/30 px-4 py-2 rounded-full inline-block mb-4">
                    {{ app()->getLocale() === 'en' ? 'Must-See Places' : 'جاهای دیدنی' }}
                </span>
                <h2 class="text-4xl lg:text-5xl font-black text-primary-800 dark:text-white mb-4">
                    {{ app()->getLocale() === 'en' ? 'Popular Destinations' : 'مکان‌های دیدنی' }}
                </h2>
                <div class="section-divider mx-auto"></div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    {{ app()->getLocale() === 'en' ? 'The most amazing places in Afghanistan' : 'شگفت‌انگیزترین نقاط افغانستان' }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($trendingDestinations as $destination)
                    <div class="group relative rounded-2xl overflow-hidden shadow-lg card-3d" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <img src="{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : asset('images/default.jpg') }}" alt="{{ locale_field($destination, 'name') }}" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 start-0 end-0 p-6 text-white">
                            <h5 class="text-lg font-bold mb-1">{{ locale_field($destination, 'name') }}</h5>
                            <p class="text-sm text-gray-300">{{ locale_field($destination->province, 'name') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-gold-500 font-bold text-sm bg-gold-50 dark:bg-gold-900/20 px-4 py-2 rounded-full inline-block mb-4">
                    {{ app()->getLocale() === 'en' ? 'Special Packages' : 'پکیج‌های ویژه' }}
                </span>
                <h2 class="text-4xl lg:text-5xl font-black text-primary-800 dark:text-white mb-4">
                    {{ app()->getLocale() === 'en' ? 'Featured Tours' : 'پکیج‌های ویژه' }}
                </h2>
                <div class="section-divider mx-auto"></div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    {{ app()->getLocale() === 'en' ? 'Best tour packages with exceptional prices' : 'بهترین پکیج‌های گردشگری با قیمت‌های استثنایی' }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($trendingPackages as $package)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg card-3d flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative">
                            <img src="{{ $package->featured_image ? asset('storage/' . $package->featured_image) : asset('images/default.jpg') }}" alt="{{ locale_field($package, 'name') }}" class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-700">

                            <!-- Fixed absolute positioning for RTL -->
                            <div class="absolute top-4 end-4 gradient-gold text-primary-900 px-4 py-2 rounded-full font-black text-lg shadow-lg">
                                {{ number_format($package->final_price) }} اف
                            </div>

                            @if ($package->discount_price)
                                <div class="absolute top-4 start-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                    {{ app()->getLocale() === 'en' ? 'Special Offer' : 'تخفیف ویژه' }}
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h5 class="text-xl font-bold mb-3">{{ locale_field($package, 'name') }}</h5>
                            <div class="flex flex-wrap items-center gap-4 text-gray-500 dark:text-gray-400 mb-4 text-sm">
                                <span class="flex items-center gap-1"><i class="far fa-clock text-primary-500"></i>
                                    {{ $package->duration_days }} {{ app()->getLocale() === 'en' ? 'Days' : 'روز' }}
                                </span>
                                <span class="flex items-center gap-1"><i class="fas fa-user text-primary-500"></i>
                                    {{ $package->max_travelers }} {{ app()->getLocale() === 'en' ? 'People' : 'نفر' }}
                                </span>
                                @if ($package->includes_guide)
                                    <span class="flex items-center gap-1"><i class="fas fa-user-tie text-primary-500"></i>
                                        {{ app()->getLocale() === 'en' ? 'Guide' : 'راهنما' }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-6 flex-grow">
                                {{ Str::limit(locale_field($package, 'description'), 100) }}
                            </p>
                            <a href="{{ route('packages.show', $package->slug) }}" class="block text-center gradient-btn text-white py-3 rounded-xl font-bold group/btn hover:shadow-xl transition-all mt-auto">
                                {{ app()->getLocale() === 'en' ? 'Book Tour' : 'رزرو پکیج ها' }}
                                <i class="fas fa-arrow-left ms-2 rtl:rotate-180"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl lg:text-5xl font-black text-primary-800 dark:text-white mb-4">
                    {{ app()->getLocale() === 'en' ? 'Why Afghan Quest?' : 'چرا افغان کویست؟' }}
                </h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature cards -->
                <div class="text-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg card-3d" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-tie text-2xl text-primary-500"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">{{ app()->getLocale() === 'en' ? 'Local Guides' : 'راهنمایان محلی' }}</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        {{ app()->getLocale() === 'en' ? 'Experienced guides familiar with all regions' : 'راهنمایان با تجربه و آشنا به تمام مناطق' }}
                    </p>
                </div>
                <div class="text-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg card-3d" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gold-100 dark:bg-gold-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl text-gold-500"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">{{ app()->getLocale() === 'en' ? 'Complete Safety' : 'امنیت کامل' }}</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        {{ app()->getLocale() === 'en' ? 'Guaranteed safety throughout your journey' : 'تضمین امنیت در تمام طول سفر' }}
                    </p>
                </div>
                <div class="text-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg card-3d" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hand-holding-heart text-2xl text-green-500"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">{{ app()->getLocale() === 'en' ? 'Affordable Prices' : 'قیمت مناسب' }}</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        {{ app()->getLocale() === 'en' ? 'Best prices with quality service' : 'بهترین قیمت با حفظ کیفیت' }}
                    </p>
                </div>
                <div class="text-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg card-3d" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-2xl text-blue-500"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-2 text-gray-800 dark:text-white">{{ app()->getLocale() === 'en' ? '24/7 Support' : 'پشتیبانی ۲۴/۷' }}</h5>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        {{ app()->getLocale() === 'en' ? 'Round-the-clock support at every stage' : 'پشتیبانی شبانه‌روزی در تمام مراحل' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 relative overflow-hidden"
        style="background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(22, 33, 62, 0.95)), url('{{ asset('images/KABUL.jpg') }}') center/cover fixed;">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-black text-white mb-6">
                {{ app()->getLocale() === 'en' ? 'Ready for an Adventure in Afghanistan?' : 'آماده ماجراجویی در افغانستان هستید؟' }}
            </h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                {{ app()->getLocale() === 'en' ? 'Book your tour now and start an unforgettable experience in the heart of Afghanistan\'s history and nature' : 'همین حالا سیاحت خود را رزرو کنید و تجربه‌ای فراموش‌نشدنی را در دل تاریخ و طبیعت افغانستان آغاز کنید' }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('packages.index') }}" class="gradient-gold text-primary-900 px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1">
                    <i class="fas fa-suitcase ms-2 rtl:rotate-180"></i>
                    {{ app()->getLocale() === 'en' ? 'Book a Tour' : 'رزرو پکیج ها' }}
                </a>
                <a href="https://wa.me/93700000000" target="_blank" class="bg-green-500 text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-green-600 transition-all transform hover:-translate-y-1">
                    <i class="fab fa-whatsapp ms-2"></i> {{ app()->getLocale() === 'en' ? 'WhatsApp' : 'واتساپ' }}
                </a>
            </div>
        </div>
    </section>

    <!-- Vanilla JS to Animate the Numbers in the Hero Section -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter');

            const animateCounters = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = +counter.getAttribute('data-target');
                        const speed = 200; // Adjust for faster/slower counting

                        const updateCount = () => {
                            const current = +counter.innerText;
                            const inc = target / speed;

                            if (current < target) {
                                counter.innerText = Math.ceil(current + inc);
                                setTimeout(updateCount, 15);
                            } else {
                                counter.innerText = target;
                            }
                        };

                        updateCount();
                        observer.unobserve(counter); // Only animate once
                    }
                });
            };

            const observer = new IntersectionObserver(animateCounters, {
                threshold: 0.5 // Start animation when 50% of the element is visible
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection
