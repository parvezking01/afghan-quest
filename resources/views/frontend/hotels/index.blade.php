@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Hotels & Accommodations' : 'هوتل‌ها و اقامتگاه‌ها')

@section('content')

    <section class="relative py-20"
        style="background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(22, 33, 62, 0.9)), url('{{ asset('images/KABUL.jpg') }}') center/cover;">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl lg:text-5xl font-black text-white mb-4">
                {{ app()->getLocale() === 'en' ? 'Hotels & Accommodations' : 'هوتل‌ها و اقامتگاه‌ها' }}</h1>
            <p class="text-xl text-gray-300">
                {{ app()->getLocale() === 'en' ? 'Best places to stay in Afghanistan' : 'بهترین مکان‌های اقامت در افغانستان' }}
            </p>
        </div>
    </section>

    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($hotels as $hotel)
                    <a href="{{ route('hotels.show', $hotel->slug) }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all"
                        data-aos="fade-up">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ $hotel->featured_image ? asset('storage/' . $hotel->featured_image) : 'https://via.placeholder.com/400' }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute bottom-4 right-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold text-gray-700 dark:text-white">
                                {{ locale_field($hotel->province, 'name') }}
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-black text-gray-800 dark:text-white mb-2">
                                {{ locale_field($hotel, 'name') }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-2"><i
                                    class="fas fa-map-marker-alt text-red-400 ms-1"></i>
                                {{ locale_field($hotel, 'address') }}</p>
                            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                <span><i class="fas fa-door-open text-blue-500 ms-1"></i> {{ $hotel->rooms->count() }}
                                    {{ app()->getLocale() === 'en' ? 'Rooms' : 'اتاق' }}</span>
                                <span><i class="fas fa-phone text-green-500 ms-1"></i> {{ $hotel->phone }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $hotels->links() }}
        </div>
    </section>

@endsection
