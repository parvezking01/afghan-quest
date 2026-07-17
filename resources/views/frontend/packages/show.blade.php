@extends('layouts.app')

@section('title', locale_field($package, 'name'))

@section('content')

    <section class="relative py-24"
        style="background: linear-gradient(rgba(26, 26, 46, 0.85), rgba(22, 33, 62, 0.9)), url('{{ $package->featured_image ? asset('storage/' . $package->featured_image) : 'https://images.unsplash.com/photo-1599070292747-ae92ea606fcf?w=1920' }}') center/cover;">
        <div class="container mx-auto px-4 text-center relative z-10">
            <span class="bg-gold-500 text-primary-900 px-4 py-2 rounded-full text-sm font-bold inline-block mb-4">
                @if ($package->type === 'provincial')
                    {{ app()->getLocale() === 'en' ? '🏛️ Provincial Tour' : '🏛️ پکیج ولایتی' }}
                @elseif($package->type === 'regional')
                    {{ app()->getLocale() === 'en' ? '🗺️ Regional Tour' : '🗺️ پکیج منطقه‌ای' }}
                @elseif($package->type === 'thematic')
                    {{ app()->getLocale() === 'en' ? '🎯 Thematic Tour' : '🎯 پکیج موضوعی' }}
                @else
                    {{ app()->getLocale() === 'en' ? '✏️ Custom Tour' : '✏️ پکیج سفارشی' }}
                @endif
            </span>
            <h1 class="text-4xl lg:text-6xl font-black text-white mb-4">{{ locale_field($package, 'name') }}</h1>
            <div class="flex justify-center gap-4 text-white">
                <span><i class="far fa-clock ms-1"></i> {{ $package->duration_days }}
                    {{ app()->getLocale() === 'en' ? 'Days' : 'روز' }} / {{ $package->duration_nights }}
                    {{ app()->getLocale() === 'en' ? 'Nights' : 'شب' }}</span>
                <span><i class="fas fa-user ms-1"></i> {{ $package->max_travelers }}
                    {{ app()->getLocale() === 'en' ? 'People' : 'نفر' }}</span>
                @if ($package->includes_guide)
                    <span><i class="fas fa-user-tie ms-1"></i>
                        {{ app()->getLocale() === 'en' ? 'With Guide' : 'با راهنما' }}</span>
                @endif
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                        <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                            {{ app()->getLocale() === 'en' ? '📝 Tour Description' : '📝 توضیحات پکیج' }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ locale_field($package, 'description') }}</p>
                    </div>

                    @if ($package->gallery_images)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '🖼️ Gallery' : '🖼️ گالری تصاویر' }}</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach (json_decode($package->gallery_images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}"
                                        class="w-full h-40 object-cover rounded-xl">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($package->destinations->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '📍 Tour Destinations' : '📍 مکان های پکیج' }}</h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach ($package->destinations as $dest)
                                    <div
                                        class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                        <img src="{{ $dest->featured_image ? asset('storage/' . $dest->featured_image) : 'https://via.placeholder.com/60' }}"
                                            class="w-14 h-14 rounded-xl object-cover">
                                        <div>
                                            <p class="font-bold text-gray-800 dark:text-white">
                                                {{ locale_field($dest, 'name') }}</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                                {{ locale_field($dest->province, 'name') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($package->included_services)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '✅ Included Services' : '✅ خدمات شامل' }}</h3>
                            <ul class="space-y-2">
                                @foreach (json_decode($package->included_services) as $service)
                                    <li class="flex items-center gap-2 text-gray-600 dark:text-gray-300"><i
                                            class="fas fa-check-circle text-green-500"></i> {{ $service }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($package->excluded_services)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '❌ Excluded Services' : '❌ خدمات شامل نمی‌شود' }}</h3>
                            <ul class="space-y-2">
                                @foreach (json_decode($package->excluded_services) as $service)
                                    <li class="flex items-center gap-2 text-gray-600 dark:text-gray-300"><i
                                            class="fas fa-times-circle text-red-500"></i> {{ $service }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($package->itinerary)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                            <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() === 'en' ? '📅 Itinerary' : '📅 برنامه سفر' }}</h3>
                            <div class="space-y-3">
                                @foreach (json_decode($package->itinerary) as $day)
                                    <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                        <span
                                            class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">{{ $loop->iteration }}</span>
                                        <p class="text-gray-600 dark:text-gray-300">{{ $day }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @include('frontend.partials.reviews', ['reviewable' => $package])
                </div>

                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm sticky top-24">
                        <div class="text-center mb-6 bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                            <p class="text-gray-400 dark:text-gray-500 text-sm mb-1">
                                {{ app()->getLocale() === 'en' ? 'Tour Price' : 'قیمت پکیج' }}</p>
                            @if ($package->discount_price)
                                <p class="text-4xl font-black text-gray-800 dark:text-white">
                                    {{ number_format($package->discount_price) }} اف</p>
                                <p class="text-lg text-red-500 line-through">{{ number_format($package->price) }} اف</p>
                                <span
                                    class="bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs px-3 py-1 rounded-full font-bold">{{ app()->getLocale() === 'en' ? 'Special Offer' : 'تخفیف ویژه' }}</span>
                            @else
                                <p class="text-4xl font-black text-gray-800 dark:text-white">
                                    {{ number_format($package->price) }} اف</p>
                            @endif
                        </div>

                        <div class="space-y-3 mb-6 text-sm">
                            <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-600"><span
                                    class="text-gray-500 dark:text-gray-400">{{ app()->getLocale() === 'en' ? '⏱️ Duration' : '⏱️ مدت پکیج' }}</span><span
                                    class="font-bold text-gray-700 dark:text-gray-200">{{ $package->duration_days }}
                                    {{ app()->getLocale() === 'en' ? 'Days' : 'روز' }} / {{ $package->duration_nights }}
                                    {{ app()->getLocale() === 'en' ? 'Nights' : 'شب' }}</span></div>
                            <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-600"><span
                                    class="text-gray-500 dark:text-gray-400">{{ app()->getLocale() === 'en' ? '👥 Capacity' : '👥 ظرفیت' }}</span><span
                                    class="font-bold text-gray-700 dark:text-gray-200">{{ $package->max_travelers }}
                                    {{ app()->getLocale() === 'en' ? 'People' : 'نفر' }}</span></div>
                            <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-600"><span
                                    class="text-gray-500 dark:text-gray-400">{{ app()->getLocale() === 'en' ? '👨‍🏫 Guide' : '👨‍🏫 راهنما' }}</span><span
                                    class="font-bold {{ $package->includes_guide ? 'text-green-500' : 'text-red-500' }}">{{ $package->includes_guide ? (app()->getLocale() === 'en' ? 'Yes ✅' : 'دارد ✅') : (app()->getLocale() === 'en' ? 'No ❌' : 'ندارد ❌') }}</span>
                            </div>
                        </div>

                        @auth
                            <a href="{{ route('booking.package.create', $package->slug) }}"
                                class="block w-full text-center bg-green-500 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-600 transition-all shadow-lg hover:shadow-xl mb-3">
                                <i class="fas fa-calendar-check ms-1"></i>
                                {{ app()->getLocale() === 'en' ? 'Book This Tour' : 'رزرو این پکیج' }}
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full text-center bg-green-500 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-600 transition-all shadow-lg hover:shadow-xl mb-3">
                                <i class="fas fa-sign-in-alt ms-1"></i>
                                {{ app()->getLocale() === 'en' ? 'Login to Book' : 'برای رزرو وارد شوید' }}
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
