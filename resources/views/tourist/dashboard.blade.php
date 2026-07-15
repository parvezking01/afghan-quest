@extends('layouts.tourist')

@section('title', app()->getLocale() === 'en' ? 'Tourist Dashboard' : 'داشبورد گردشگر')

@section('content')

<!-- Welcome Card -->
<div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-8 mb-8 text-white relative overflow-hidden" data-aos="fade-up">
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-20 -translate-y-20"></div>
    <div class="absolute bottom-0 right-0 w-48 h-48 bg-white/10 rounded-full translate-x-10 translate-y-10"></div>

    <div class="relative z-10">
        <h1 class="text-3xl font-black mb-2">{{ app()->getLocale() === 'en' ? 'Hello' : 'سلام' }} {{ auth()->user()->name }}! 👋</h1>
        <p class="text-blue-100 text-lg">{{ app()->getLocale() === 'en' ? 'Ready for your next adventure?' : 'آماده ماجراجویی بعدی هستید؟' }}</p>
        <div class="flex gap-4 mt-6">
            <a href="{{ route('packages.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-xl font-bold hover:shadow-lg transition-all">
                <i class="fas fa-suitcase ms-1"></i> {{ app()->getLocale() === 'en' ? 'View Tours' : 'مشاهده پکیج ها' }}
            </a>
            <a href="{{ route('provinces.index') }}" class="bg-white/20 text-white px-6 py-3 rounded-xl font-bold hover:bg-white/30 transition-all backdrop-blur-sm">
                <i class="fas fa-compass ms-1"></i> {{ app()->getLocale() === 'en' ? 'Explore' : 'کشف مکان ها' }}
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8" data-aos="fade-up">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center">
        <div class="text-3xl mb-2">📅</div>
        <h3 class="text-2xl font-black text-gray-700 dark:text-white">{{ $totalBookings }}</h3>
        <p class="text-gray-400 dark:text-gray-500 text-sm">{{ app()->getLocale() === 'en' ? 'Total Bookings' : 'کل رزروها' }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center">
        <div class="text-3xl mb-2">✅</div>
        <h3 class="text-2xl font-black text-green-600 dark:text-green-400">{{ $confirmedBookings }}</h3>
        <p class="text-gray-400 dark:text-gray-500 text-sm">{{ app()->getLocale() === 'en' ? 'Confirmed' : 'تایید شده' }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center">
        <div class="text-3xl mb-2">⏳</div>
        <h3 class="text-2xl font-black text-amber-600 dark:text-amber-400">{{ $pendingBookings }}</h3>
        <p class="text-gray-400 dark:text-gray-500 text-sm">{{ app()->getLocale() === 'en' ? 'Pending' : 'در انتظار' }}</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8" data-aos="fade-up">
    <a href="{{ route('packages.index') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center hover:shadow-lg hover:border-blue-200 dark:hover:border-blue-800 transition-all group">
        <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/50 transition-colors">
            <i class="fas fa-suitcase text-blue-600 dark:text-blue-400 text-2xl"></i>
        </div>
        <span class="font-bold text-gray-600 dark:text-gray-300 text-sm">{{ app()->getLocale() === 'en' ? 'Book Tour' : 'رزرو پکیج' }}</span>
    </a>
    <a href="{{ route('hotels.index') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center hover:shadow-lg hover:border-emerald-200 dark:hover:border-emerald-800 transition-all group">
        <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/50 transition-colors">
            <i class="fas fa-hotel text-emerald-600 dark:text-emerald-400 text-2xl"></i>
        </div>
        <span class="font-bold text-gray-600 dark:text-gray-300 text-sm">{{ app()->getLocale() === 'en' ? 'Book Hotel' : 'رزرو هوتل' }}</span>
    </a>
    <a href="{{ route('tourist.bookings') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center hover:shadow-lg hover:border-purple-200 dark:hover:border-purple-800 transition-all group">
        <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-100 dark:group-hover:bg-purple-900/50 transition-colors">
            <i class="fas fa-list-check text-purple-600 dark:text-purple-400 text-2xl"></i>
        </div>
        <span class="font-bold text-gray-600 dark:text-gray-300 text-sm">{{ app()->getLocale() === 'en' ? 'My Bookings' : 'رزروهای من' }}</span>
    </a>
    <a href="{{ route('tourist.profile') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 text-center hover:shadow-lg hover:border-amber-200 dark:hover:border-amber-800 transition-all group">
        <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-100 dark:group-hover:bg-amber-900/50 transition-colors">
            <i class="fas fa-user-edit text-amber-600 dark:text-amber-400 text-2xl"></i>
        </div>
        <span class="font-bold text-gray-600 dark:text-gray-300 text-sm">{{ app()->getLocale() === 'en' ? 'Edit Profile' : 'ویرایش پروفایل' }}</span>
    </a>
</div>

<!-- Recent Bookings -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden" data-aos="fade-up">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <h4 class="font-bold text-gray-700 dark:text-gray-200 text-lg">📋 {{ app()->getLocale() === 'en' ? 'My Recent Bookings' : 'آخرین رزروهای من' }}</h4>
        <a href="{{ route('tourist.bookings') }}" class="text-sm text-blue-500 hover:text-blue-600 font-medium">{{ app()->getLocale() === 'en' ? 'View All →' : 'مشاهده همه ←' }}</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Booking #' : 'شماره رزرو' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Type' : 'نوع' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Details' : 'جزئیات' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Amount' : 'مبلغ' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Status' : 'وضعیت' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Date' : 'تاریخ' }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="py-4 px-4">
                        <span class="text-sm font-mono font-medium text-gray-600 dark:text-gray-300">{{ $booking->booking_number }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-lg text-xs font-medium">
                            {{ $booking->booking_type === 'package' ? (app()->getLocale() === 'en' ? '📦 Tour' : '📦 پکیج') : (app()->getLocale() === 'en' ? '🏨 Hotel' : '🏨 هوتل') }}
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ $booking->package->name ?? $booking->hotel->name ?? '-' }}
                        </p>
                        @if($booking->travel_date)<p class="text-xs text-gray-400 dark:text-gray-500">📅 {{ $booking->travel_date->format('Y-m-d') }}</p>@endif
                        @if($booking->check_in_date)<p class="text-xs text-gray-400 dark:text-gray-500">🏨 {{ $booking->check_in_date->format('Y-m-d') }} → {{ $booking->check_out_date?->format('Y-m-d') }}</p>@endif
                    </td>
                    <td class="py-4 px-4 text-sm font-bold text-gray-700 dark:text-gray-200">{{ number_format($booking->total_amount) }} اف</td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400' : '' }}
                            {{ $booking->status === 'contacted' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : '' }}">
                            @if($booking->status === 'confirmed') {{ app()->getLocale() === 'en' ? '✅ Confirmed' : '✅ تایید شده' }}
                            @elseif($booking->status === 'pending') {{ app()->getLocale() === 'en' ? '⏳ Pending' : '⏳ در انتظار' }}
                            @elseif($booking->status === 'contacted') {{ app()->getLocale() === 'en' ? '📞 Contacted' : '📞 تماس گرفته شده' }}
                            @elseif($booking->status === 'completed') {{ app()->getLocale() === 'en' ? '🎉 Completed' : '🎉 تکمیل شده' }}
                            @else {{ app()->getLocale() === 'en' ? '❌ Cancelled' : '❌ لغو شده' }}
                            @endif
                        </span>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-400 dark:text-gray-500">{{ $booking->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12">
                        <div class="text-5xl mb-4">🧳</div>
                        <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'No Bookings Yet' : 'هنوز رزروی ندارید' }}</h3>
                        <p class="text-gray-400 dark:text-gray-500 mb-4">{{ app()->getLocale() === 'en' ? 'Start your first journey with Afghan Quest' : 'اولین سفر خود را با افغان کویست آغاز کنید' }}</p>
                        <a href="{{ route('packages.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-600 transition-colors inline-block">
                            {{ app()->getLocale() === 'en' ? 'View Tours' : 'مشاهده پکیج ها' }}
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
