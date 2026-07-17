@extends('layouts.admin')

@section('title', 'داشبورد مدیریت')
@section('page_title', 'داشبورد مدیریت')
@section('page_subtitle', 'نمای کلی سیستم')

@section('content')

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Provinces -->
        <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all"
            data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-map-marked-alt text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
                <span
                    class="text-xs font-medium text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-lg">کل</span>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $stats['total_provinces'] }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">ولایت</p>
        </div>

        <!-- Destinations -->
        <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all"
            data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-landmark text-emerald-600 dark:text-emerald-400 text-xl"></i>
                </div>
                <span
                    class="text-xs font-medium text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-lg">فعال</span>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $stats['total_destinations'] }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">مقصد گردشگری</p>
        </div>

        <!-- Hotels -->
        <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all"
            data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hotel text-amber-600 dark:text-amber-400 text-xl"></i>
                </div>
                <span
                    class="text-xs font-medium text-red-400 bg-red-50 dark:bg-red-900/30 dark:text-red-400 px-2 py-1 rounded-lg">{{ $stats['pending_hotels'] }}
                    در انتظار</span>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $stats['total_hotels'] }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">هتل</p>
        </div>

        <!-- Packages -->
        <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all"
            data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-violet-50 dark:bg-violet-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-box text-violet-600 dark:text-violet-400 text-xl"></i>
                </div>
                <span
                    class="text-xs font-medium text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-lg">فعال</span>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $stats['total_packages'] }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">پکیج تور</p>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Users -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-gray-600 dark:text-gray-300">👥 کاربران</h4>
                <span class="text-2xl font-black text-gray-700 dark:text-white">{{ $stats['total_users'] }}</span>
            </div>
            <div class="flex gap-2 text-sm">
                <span
                    class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1.5 rounded-lg font-medium">
                    🧳 گردشگر: {{ $stats['total_users'] - $stats['pending_owners'] }}
                </span>
                <span
                    class="bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 px-3 py-1.5 rounded-lg font-medium">
                    🏨 مالک: {{ $stats['pending_owners'] }}
                </span>
            </div>
        </div>

        <!-- Bookings -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-gray-600 dark:text-gray-300">📅 رزروها</h4>
                <span class="text-2xl font-black text-gray-700 dark:text-white">{{ $stats['total_bookings'] }}</span>
            </div>
            <div class="flex gap-2 text-sm">
                <span
                    class="bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 px-3 py-1.5 rounded-lg font-medium">
                    ⏳ در انتظار: {{ $stats['pending_bookings'] }}
                </span>
                <span
                    class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 px-3 py-1.5 rounded-lg font-medium">
                    ✅ تایید شده
                </span>
            </div>
        </div>

        <!-- Revenue -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-gray-600 dark:text-gray-300">💰 درآمد کل</h4>
                <span
                    class="text-xs font-medium text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 px-2 py-1 rounded-lg">افغانی</span>
            </div>
            <p class="text-3xl font-black text-gray-700 dark:text-white">۰</p>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">در این ماه</p>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm mb-8 overflow-hidden"
        data-aos="fade-up">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h4 class="font-bold text-gray-600 dark:text-gray-300 text-lg">📋 آخرین رزروها</h4>
            <a href="{{ route('admin.bookings.index') }}"
                class="text-sm text-blue-500 hover:text-blue-600 font-medium">مشاهده همه ←</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-700/50">
                        <th
                            class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                            شماره رزرو</th>
                        <th
                            class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                            کاربر</th>
                        <th
                            class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                            نوع</th>
                        <th
                            class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                            مبلغ</th>
                        <th
                            class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                            وضعیت</th>
                        <th
                            class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                            تاریخ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    @forelse($stats['recent_bookings'] as $booking)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="py-4 px-6">
                                <span
                                    class="text-sm font-mono font-medium text-gray-600 dark:text-gray-300">{{ $booking->booking_number }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 bg-gray-100 dark:bg-gray-600 rounded-full flex items-center justify-center text-xs font-bold text-gray-500 dark:text-gray-300">
                                        {{ mb_substr($booking->user->name ?? '؟', 0, 1) }}
                                    </div>
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-300">{{ $booking->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span
                                    class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-lg text-xs font-medium">
                                    {{ $booking->booking_type === 'package' ? '📦 تور' : '🏨 هتل' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm font-bold text-gray-600 dark:text-gray-300">
                                {{ number_format($booking->total_amount) }} اف
                            </td>
                            <td class="py-4 px-6">
                                <span
                                    class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400' : '' }}">
                                    {{ $booking->status === 'confirmed' ? '✅ تایید شده' : ($booking->status === 'pending' ? '⏳ در انتظار' : '❌ لغو شده') }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-400 dark:text-gray-500">
                                {{ $booking->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="text-4xl mb-3">📭</div>
                                <p class="text-gray-400 dark:text-gray-500">هیچ رزروی وجود ندارد</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
