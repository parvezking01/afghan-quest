@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Search Results' : 'نتایج جستجو')

@section('content')

    <section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-black text-gray-800 dark:text-white mb-2">
                {{ app()->getLocale() === 'en' ? 'Search Results' : 'نتایج جستجو' }}
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mb-8">
                {{ app()->getLocale() === 'en' ? 'Results for:' : 'نتایج برای:' }} <strong>"{{ $query }}"</strong>
            </p>

            @if ($provinces->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">🏛️
                        {{ app()->getLocale() === 'en' ? 'Provinces' : 'ولایات' }}</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($provinces as $province)
                            <a href="{{ route('provinces.show', $province->slug) }}"
                                class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-500">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-700 dark:text-white">
                                        {{ locale_field($province, 'name') }}</h5>
                                    <p class="text-xs text-gray-400">
                                        {{ Str::limit(locale_field($province, 'description'), 60) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($destinations->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">🗺️
                        {{ app()->getLocale() === 'en' ? 'Destinations' : 'مقاصد' }}</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($destinations as $destination)
                            <a href="{{ route('destinations.show', $destination->slug) }}"
                                class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all flex items-center gap-3">
                                <img src="{{ $destination->featured_image ? asset('storage/' . $destination->featured_image) : 'https://via.placeholder.com/48' }}"
                                    class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <h5 class="font-bold text-gray-700 dark:text-white">
                                        {{ locale_field($destination, 'name') }}</h5>
                                    <p class="text-xs text-gray-400">{{ locale_field($destination->province, 'name') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($hotels->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">🏨
                        {{ app()->getLocale() === 'en' ? 'Hotels' : 'هتل‌ها' }}</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($hotels as $hotel)
                            <a href="{{ route('hotels.show', $hotel->slug) }}"
                                class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all flex items-center gap-3">
                                <img src="{{ $hotel->featured_image ? asset('storage/' . $hotel->featured_image) : 'https://via.placeholder.com/48' }}"
                                    class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <h5 class="font-bold text-gray-700 dark:text-white">{{ locale_field($hotel, 'name') }}
                                    </h5>
                                    <p class="text-xs text-gray-400">{{ locale_field($hotel->province, 'name') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($packages->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">📦
                        {{ app()->getLocale() === 'en' ? 'Tour Packages' : 'پکیج‌های تور' }}</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($packages as $package)
                            <a href="{{ route('packages.show', $package->slug) }}"
                                class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-all flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center text-purple-500">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-700 dark:text-white">
                                        {{ locale_field($package, 'name') }}</h5>
                                    <p class="text-xs text-gray-400">{{ $package->duration_days }}
                                        {{ app()->getLocale() === 'en' ? 'Days' : 'روز' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($provinces->count() == 0 && $destinations->count() == 0 && $hotels->count() == 0 && $packages->count() == 0)
                <div class="text-center py-20">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-xl font-bold text-gray-600 dark:text-gray-300">
                        {{ app()->getLocale() === 'en' ? 'No results found' : 'نتیجه‌ای یافت نشد' }}</h3>
                    <p class="text-gray-400 mt-2">
                        {{ app()->getLocale() === 'en' ? 'Try a different search term' : 'عبارت دیگری را جستجو کنید' }}</p>
                </div>
            @endif
        </div>
    </section>

@endsection
