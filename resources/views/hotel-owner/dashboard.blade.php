@extends('layouts.hotel-owner')

@section('title', 'داشبورد')
@section('page_title', 'داشبورد هوتل')
@section('page_subtitle', 'خلاصه وضعیت هوتل‌های شما')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hotel text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $totalHotels }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">هوتل‌های شما</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-door-open text-emerald-600 dark:text-emerald-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $totalRooms }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">کل اتاق‌ها</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-amber-600 dark:text-amber-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-amber-600 dark:text-amber-400">{{ $pendingBookings }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">در انتظار تایید</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
            data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-check text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-gray-700 dark:text-white">{{ $totalBookings }}</h3>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">کل رزروها</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('hotel_owner.hotels.index') }}"
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg transition-all text-center group">
            <i
                class="fas fa-hotel text-4xl text-blue-500 dark:text-blue-400 mb-3 group-hover:scale-110 transition-transform"></i>
            <h4 class="font-bold text-gray-700 dark:text-gray-200">مدیریت هوتل‌ها</h4>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">افزودن و ویرایش هوتل‌ها</p>
        </a>

        <a href="{{ route('hotel_owner.bookings') }}"
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg transition-all text-center group">
            <i
                class="fas fa-calendar-check text-4xl text-green-500 dark:text-green-400 mb-3 group-hover:scale-110 transition-transform"></i>
            <h4 class="font-bold text-gray-700 dark:text-gray-200">مدیریت رزروها</h4>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">مشاهده و تایید رزروها</p>
        </a>
    </div>

    <div
        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h4 class="font-bold text-gray-700 dark:text-gray-200 text-lg">📋 آخرین رزروها</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مهمان
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">هوتل
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">واتساپ
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مبلغ
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت
                        </th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                            <td class="py-4 px-6 text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ $booking->user->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">
                                {{ $booking->hotel->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">{{ $booking->whatsapp_number }}
                            </td>
                            <td class="py-4 px-6 text-sm font-bold text-gray-700 dark:text-gray-200">
                                {{ number_format($booking->total_amount) }} اف</td>
                            <td class="py-4 px-6">
                                <span
                                    class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' : '' }}">
                                    {{ $booking->status === 'confirmed' ? '✅ تایید شده' : '⏳ در انتظار' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2">
                                    @if ($booking->status === 'pending')
                                        <form action="{{ route('hotel_owner.bookings.status', $booking) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button
                                                class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 p-2 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/50"
                                                title="تایید">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="https://wa.me/{{ $booking->whatsapp_number }}" target="_blank"
                                        class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50"
                                        title="واتساپ">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400 dark:text-gray-500">هیچ رزروی وجود
                                ندارد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
