@extends('layouts.hotel-owner')

@section('title', 'رزروها')
@section('page_title', 'مدیریت رزروها')
@section('page_subtitle', 'مشاهده و تایید رزروهای هوتل‌های شما')

@section('content')

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">شماره رزرو</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مهمان</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">هوتل</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نوع اتاق</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تاریخ</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مبلغ</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت</th>
                    <th class="text-right py-4 px-6 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                    <td class="py-4 px-6 text-sm font-mono text-gray-700 dark:text-gray-200">{{ $booking->booking_number }}</td>
                    <td class="py-4 px-6">
                        <p class="font-medium text-gray-700 dark:text-gray-200">{{ $booking->user->name ?? '-' }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $booking->whatsapp_number }}</p>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">{{ $booking->hotel->name ?? '-' }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">{{ $booking->room->room_type ?? '-' }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-300">
                        {{ $booking->check_in_date?->format('Y-m-d') }} تا {{ $booking->check_out_date?->format('Y-m-d') }}
                    </td>
                    <td class="py-4 px-6 text-sm font-bold text-gray-700 dark:text-gray-200">{{ number_format($booking->total_amount) }} اف</td>
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400' : '' }}">
                            {{ $booking->status === 'confirmed' ? '✅ تایید شده' : ($booking->status === 'pending' ? '⏳ در انتظار' : '❌ لغو شده') }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex gap-2">
                            @if($booking->status === 'pending')
                            <form action="{{ route('hotel_owner.bookings.status', $booking) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button class="bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 p-2 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/50" title="تایید">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('hotel_owner.bookings.status', $booking) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50" title="لغو">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif
                            <a href="https://wa.me/{{ $booking->whatsapp_number }}" target="_blank"
                               class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50" title="واتساپ">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-12 text-gray-400 dark:text-gray-500">هیچ رزروی وجود ندارد</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">{{ $bookings->links() }}</div>
    @endif
</div>

@endsection
