@extends('layouts.app')

@section('title', locale_field($hotel, 'name'))

@section('content')

<section class="relative py-24" style="background: linear-gradient(rgba(26, 26, 46, 0.8), rgba(22, 33, 62, 0.85)), url('{{ $hotel->featured_image ? asset('storage/' . $hotel->featured_image) : 'https://images.unsplash.com/photo-1604941210895-7a103134c643?w=1920' }}') center/cover;">
    <div class="container mx-auto px-4 text-center relative z-10">
        <span class="text-blue-300 text-sm font-bold">{{ locale_field($hotel->province, 'name') }}</span>
        <h1 class="text-4xl lg:text-6xl font-black text-white mb-4">{{ locale_field($hotel, 'name') }}</h1>
        <p class="text-gray-300"><i class="fas fa-map-marker-alt ms-1"></i> {{ locale_field($hotel, 'address') }}</p>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">{{ app()->getLocale() === 'en' ? '📝 Description' : '📝 توضیحات' }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ locale_field($hotel, 'description') }}</p>
                </div>

                @if($hotel->gallery_images)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm mb-6">
                    <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">{{ app()->getLocale() === 'en' ? '🖼️ Gallery' : '🖼️ گالری تصاویر' }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(json_decode($hotel->gallery_images) as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="w-full h-40 object-cover rounded-xl">
                        @endforeach
                    </div>
                </div>
                @endif

                @if($hotel->rooms->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-xl font-black text-gray-800 dark:text-white mb-4">{{ app()->getLocale() === 'en' ? '🚪 Available Rooms' : '🚪 اتاق‌های موجود' }}</h3>
                    <div class="space-y-4">
                        @foreach($hotel->rooms as $room)
                        <div class="flex flex-col md:flex-row md:items-center justify-between p-5 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <div class="mb-3 md:mb-0">
                                <h5 class="font-bold text-gray-800 dark:text-white text-lg">{{ locale_field($room, 'room_type') }}</h5>
                                @if($room->description)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ locale_field($room, 'description') }}</p>@endif
                                <div class="flex gap-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span><i class="fas fa-user ms-1"></i> {{ app()->getLocale() === 'en' ? 'Capacity' : 'ظرفیت' }}: {{ $room->capacity }} {{ app()->getLocale() === 'en' ? 'People' : 'نفر' }}</span>
                                    <span><i class="fas fa-door-open ms-1"></i> {{ app()->getLocale() === 'en' ? 'Available' : 'موجود' }}: {{ $room->available_rooms }} {{ app()->getLocale() === 'en' ? 'Rooms' : 'اتاق' }}</span>
                                </div>
                            </div>
                            <div class="text-left">
                                <p class="text-2xl font-black text-gray-800 dark:text-white">{{ number_format($room->price_per_night) }} اف</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ app()->getLocale() === 'en' ? 'Per Night' : 'هر شب' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-12 shadow-sm text-center">
                    <div class="text-5xl mb-4">🚪</div>
                    <h3 class="text-xl font-black text-gray-600 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'No Rooms Registered' : 'اتاقی ثبت نشده است' }}</h3>
                    <p class="text-gray-400 dark:text-gray-500">{{ app()->getLocale() === 'en' ? 'Please contact the hotel for room availability.' : 'لطفاً برای اطلاع از اتاق‌های موجود با هتل تماس بگیرید.' }}</p>
                </div>
                @endif
            </div>

            <div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm sticky top-24">
                    <h4 class="font-black text-gray-800 dark:text-white mb-4">{{ app()->getLocale() === 'en' ? 'ℹ️ Hotel Info' : 'ℹ️ اطلاعات هتل' }}</h4>

                    <div class="space-y-4 text-sm mb-6">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-phone text-green-500"></i>
                            <a href="tel:{{ $hotel->phone }}" class="text-blue-500 font-bold hover:underline">{{ $hotel->phone }}</a>
                        </div>
                        @if($hotel->whatsapp)
                        <div class="flex items-center gap-2">
                            <i class="fab fa-whatsapp text-green-500"></i>
                            <span class="text-gray-600 dark:text-gray-300">{{ $hotel->whatsapp }}</span>
                        </div>
                        @endif
                        @if($hotel->email)
                        <div class="flex items-center gap-2"><i class="fas fa-envelope text-blue-500"></i><span class="text-gray-600 dark:text-gray-300">{{ $hotel->email }}</span></div>
                        @endif
                        <hr class="border-gray-200 dark:border-gray-600">
                        <div class="flex justify-between"><span class="text-gray-500 dark:text-gray-400">{{ app()->getLocale() === 'en' ? '🕐 Check-in' : '🕐 ورود' }}</span><span class="font-bold text-gray-700 dark:text-gray-200">{{ $hotel->check_in_time }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-500 dark:text-gray-400">{{ app()->getLocale() === 'en' ? '🕛 Check-out' : '🕛 خروج' }}</span><span class="font-bold text-gray-700 dark:text-gray-200">{{ $hotel->check_out_time }}</span></div>
                        @if($hotel->languages_spoken)<div class="flex justify-between"><span class="text-gray-500 dark:text-gray-400">{{ app()->getLocale() === 'en' ? '🗣️ Languages' : '🗣️ زبان' }}</span><span class="font-bold text-gray-700 dark:text-gray-200">{{ $hotel->languages_spoken }}</span></div>@endif
                    </div>

                    @auth
                    <a href="{{ route('booking.hotel.create', $hotel->slug) }}"
                       class="block w-full text-center bg-green-500 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-600 transition-all shadow-lg hover:shadow-xl mb-3">
                        <i class="fas fa-calendar-check ms-1"></i> {{ app()->getLocale() === 'en' ? 'Book a Room' : 'رزرو اتاق' }}
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                       class="block w-full text-center bg-green-500 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-600 transition-all shadow-lg hover:shadow-xl mb-3">
                        <i class="fas fa-sign-in-alt ms-1"></i> {{ app()->getLocale() === 'en' ? 'Login to Book' : 'برای رزرو وارد شوید' }}
                    </a>
                    <p class="text-center text-gray-400 dark:text-gray-500 text-xs">{{ app()->getLocale() === 'en' ? 'You need an account to book a hotel' : 'برای رزرو هتل نیاز به حساب کاربری دارید' }}</p>
                    @endauth

                    <a href="tel:{{ $hotel->phone }}" class="block text-center border-2 border-blue-500 text-blue-500 dark:text-blue-400 py-3 rounded-xl font-bold hover:bg-blue-500 hover:text-white transition-all">
                        <i class="fas fa-phone ms-1"></i> {{ app()->getLocale() === 'en' ? 'Call Hotel' : 'تماس با هتل' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.partials.reviews', ['reviewable' => $hotel])
</section>

@endsection
