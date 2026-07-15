@extends('layouts.hotel-owner')

@section('title', 'هوتل‌های من')
@section('page_title', 'هوتل‌های من')
@section('page_subtitle', 'مدیریت هوتل‌های ثبت شده')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 dark:text-gray-400">کل: <span class="font-bold text-gray-700 dark:text-white">{{ $hotels->count() }}</span> هوتل</p>
    <a href="{{ route('hotel_owner.hotels.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
        <i class="fas fa-plus ms-1"></i> افزودن هوتل جدید
    </a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($hotels as $hotel)
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden hover:shadow-lg transition-all">
        <div class="relative h-48 bg-gradient-to-br from-blue-400 to-blue-600">
            @if($hotel->featured_image)
            <img src="{{ asset('storage/' . $hotel->featured_image) }}" class="w-full h-full object-cover">
            @else
            <div class="flex items-center justify-center h-full">
                <i class="fas fa-hotel text-white text-6xl opacity-30"></i>
            </div>
            @endif
            <div class="absolute top-3 left-3">
                <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $hotel->is_approved ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                    {{ $hotel->is_approved ? '✅ تایید شده' : '⏳ در انتظار تایید' }}
                </span>
            </div>
        </div>
        <div class="p-5">
            <h5 class="text-lg font-bold text-gray-800 dark:text-white mb-2">{{ $hotel->name }}</h5>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">
                <i class="fas fa-map-marker-alt text-blue-500 dark:text-blue-400 ms-1"></i> {{ $hotel->province->name ?? 'نامشخص' }}
            </p>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-3"><i class="fas fa-phone ms-1"></i> {{ $hotel->phone }}</p>
            <div class="flex gap-2 mt-4">
                <a href="{{ route('hotel_owner.hotels.edit', $hotel) }}" class="flex-1 text-center bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 py-2 rounded-lg text-sm font-bold hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                    <i class="fas fa-edit ms-1"></i> ویرایش
                </a>
                <a href="{{ route('hotel_owner.rooms.index', $hotel) }}" class="flex-1 text-center bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 py-2 rounded-lg text-sm font-bold hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition-colors">
                    <i class="fas fa-door-open ms-1"></i> اتاق‌ها
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 bg-white dark:bg-gray-800 rounded-2xl">
        <div class="text-6xl mb-4">🏨</div>
        <h3 class="text-xl font-bold text-gray-600 dark:text-gray-300 mb-2">هنوز هوتلی ثبت نکرده‌اید</h3>
        <p class="text-gray-400 dark:text-gray-500 mb-6">اولین هوتل خود را اضافه کنید</p>
        <a href="{{ route('hotel_owner.hotels.create') }}" class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors inline-block">
            <i class="fas fa-plus ms-1"></i> افزودن هوتل جدید
        </a>
    </div>
    @endforelse
</div>

@endsection
