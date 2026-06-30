@extends('layouts.admin')

@section('title', 'مدیریت پرطرفدارها')
@section('page_title', 'مدیریت پرطرفدارها')
@section('page_subtitle', 'انتخاب کنید کدام موارد در صفحه اصلی نمایش داده شوند')

@section('content')

<!-- Info Alert -->
<div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6">
    <p class="text-blue-700 dark:text-blue-400 text-sm">
        <i class="fas fa-info-circle ms-1"></i>
        مواردی که به عنوان <strong>پرطرفدار</strong> انتخاب می‌شوند، در صفحه اصلی سایت نمایش داده می‌شوند.
    </p>
</div>

<div class="grid lg:grid-cols-2 gap-6">

    <!-- Provinces -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="font-black text-gray-800 dark:text-white">🏛️ ولایات</h3>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $provinces->where('is_trending', true)->count() }} مورد پرطرفدار</p>
        </div>
        <div class="p-4 max-h-96 overflow-y-auto">
            <div class="space-y-2">
                @foreach($provinces as $province)
                <div class="flex items-center justify-between p-3 rounded-xl {{ $province->is_trending ? 'bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800' : 'bg-gray-50 dark:bg-gray-700/30' }}">
                    <div class="flex items-center gap-3">
                        @if($province->featured_image)
                        <img src="{{ asset('storage/' . $province->featured_image) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center text-gray-400 dark:text-gray-500">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        @endif
                        <span class="font-medium text-gray-700 dark:text-gray-200 text-sm">{{ $province->name }}</span>
                    </div>
                    <form action="{{ route('admin.trending.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="province">
                        <input type="hidden" name="id" value="{{ $province->id }}">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold transition-colors
                            {{ $province->is_trending ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400' : 'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400 hover:bg-amber-100 dark:hover:bg-amber-900/30 hover:text-amber-600 dark:hover:text-amber-400' }}">
                            {{ $province->is_trending ? '⭐ پرطرفدار' : 'افزودن' }}
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Destinations -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="font-black text-gray-800 dark:text-white">🗺️ مقاصد</h3>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $destinations->where('is_trending', true)->count() }} مورد پرطرفدار</p>
        </div>
        <div class="p-4 max-h-96 overflow-y-auto">
            <div class="space-y-2">
                @foreach($destinations as $destination)
                <div class="flex items-center justify-between p-3 rounded-xl {{ $destination->is_trending ? 'bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800' : 'bg-gray-50 dark:bg-gray-700/30' }}">
                    <div class="flex items-center gap-3">
                        @if($destination->featured_image)
                        <img src="{{ asset('storage/' . $destination->featured_image) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center text-gray-400 dark:text-gray-500">
                            <i class="fas fa-landmark"></i>
                        </div>
                        @endif
                        <div>
                            <span class="font-medium text-gray-700 dark:text-gray-200 text-sm">{{ $destination->name }}</span>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $destination->province->name }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.trending.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="destination">
                        <input type="hidden" name="id" value="{{ $destination->id }}">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold transition-colors
                            {{ $destination->is_trending ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400' : 'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400 hover:bg-amber-100 dark:hover:bg-amber-900/30 hover:text-amber-600 dark:hover:text-amber-400' }}">
                            {{ $destination->is_trending ? '⭐ پرطرفدار' : 'افزودن' }}
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hotels -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="font-black text-gray-800 dark:text-white">🏨 هتل‌ها</h3>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $hotels->where('is_trending', true)->count() }} مورد پرطرفدار</p>
        </div>
        <div class="p-4 max-h-96 overflow-y-auto">
            <div class="space-y-2">
                @foreach($hotels as $hotel)
                <div class="flex items-center justify-between p-3 rounded-xl {{ $hotel->is_trending ? 'bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800' : 'bg-gray-50 dark:bg-gray-700/30' }}">
                    <div class="flex items-center gap-3">
                        @if($hotel->featured_image)
                        <img src="{{ asset('storage/' . $hotel->featured_image) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center text-gray-400 dark:text-gray-500">
                            <i class="fas fa-hotel"></i>
                        </div>
                        @endif
                        <div>
                            <span class="font-medium text-gray-700 dark:text-gray-200 text-sm">{{ $hotel->name }}</span>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $hotel->province->name }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.trending.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="hotel">
                        <input type="hidden" name="id" value="{{ $hotel->id }}">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold transition-colors
                            {{ $hotel->is_trending ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400' : 'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400 hover:bg-amber-100 dark:hover:bg-amber-900/30 hover:text-amber-600 dark:hover:text-amber-400' }}">
                            {{ $hotel->is_trending ? '⭐ پرطرفدار' : 'افزودن' }}
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Packages -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="font-black text-gray-800 dark:text-white">📦 پکیج‌ها</h3>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $packages->where('is_trending', true)->count() }} مورد پرطرفدار</p>
        </div>
        <div class="p-4 max-h-96 overflow-y-auto">
            <div class="space-y-2">
                @foreach($packages as $package)
                <div class="flex items-center justify-between p-3 rounded-xl {{ $package->is_trending ? 'bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800' : 'bg-gray-50 dark:bg-gray-700/30' }}">
                    <div class="flex items-center gap-3">
                        @if($package->featured_image)
                        <img src="{{ asset('storage/' . $package->featured_image) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                        <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center text-gray-400 dark:text-gray-500">
                            <i class="fas fa-box"></i>
                        </div>
                        @endif
                        <span class="font-medium text-gray-700 dark:text-gray-200 text-sm">{{ $package->name }}</span>
                    </div>
                    <form action="{{ route('admin.trending.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="package">
                        <input type="hidden" name="id" value="{{ $package->id }}">
                        <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold transition-colors
                            {{ $package->is_trending ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400' : 'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400 hover:bg-amber-100 dark:hover:bg-amber-900/30 hover:text-amber-600 dark:hover:text-amber-400' }}">
                            {{ $package->is_trending ? '⭐ پرطرفدار' : 'افزودن' }}
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection
