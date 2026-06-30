@extends('layouts.tourist')

@section('title', app()->getLocale() === 'en' ? 'My Bookings' : 'رزروهای من')

@section('content')

<h2 class="text-2xl font-black text-gray-800 dark:text-white mb-6">📋 {{ app()->getLocale() === 'en' ? 'My Bookings' : 'رزروهای من' }}</h2>

@if($bookings->count() > 0)
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Booking #' : 'کد رزرو' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Type' : 'نوع' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Details' : 'جزئیات' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Amount' : 'مبلغ' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Status' : 'وضعیت' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'Date' : 'تاریخ' }}</th>
                    <th class="text-right py-4 px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">{{ app()->getLocale() === 'en' ? 'WhatsApp' : 'واتساپ' }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @foreach($bookings as $booking)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                    <td class="py-4 px-4">
                        <span class="text-sm font-mono font-bold text-gray-600 dark:text-gray-300">{{ $booking->booking_number }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $booking->booking_type === 'package' ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' }}">
                            {{ $booking->booking_type === 'package' ? (app()->getLocale() === 'en' ? '📦 Tour' : '📦 تور') : (app()->getLocale() === 'en' ? '🏨 Hotel' : '🏨 هتل') }}
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ $booking->package->name ?? $booking->hotel->name ?? '-' }}
                        </p>
                        @if($booking->travel_date)
                        <p class="text-xs text-gray-400 dark:text-gray-500">📅 {{ $booking->travel_date->format('Y-m-d') }}</p>
                        @endif
                        @if($booking->check_in_date)
                        <p class="text-xs text-gray-400 dark:text-gray-500">🏨 {{ $booking->check_in_date->format('Y-m-d') }} → {{ $booking->check_out_date?->format('Y-m-d') }}</p>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-sm font-bold text-gray-700 dark:text-gray-200">
                        {{ number_format($booking->total_amount) }} اف
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' : '' }}
                            {{ $booking->status === 'contacted' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : '' }}">
                            @if($booking->status === 'pending') {{ app()->getLocale() === 'en' ? '⏳ Pending' : '⏳ در انتظار' }}
                            @elseif($booking->status === 'contacted') {{ app()->getLocale() === 'en' ? '📞 Contacted' : '📞 تماس گرفته شد' }}
                            @elseif($booking->status === 'confirmed') {{ app()->getLocale() === 'en' ? '✅ Confirmed' : '✅ تایید شده' }}
                            @elseif($booking->status === 'cancelled') {{ app()->getLocale() === 'en' ? '❌ Cancelled' : '❌ لغو شده' }}
                            @elseif($booking->status === 'completed') {{ app()->getLocale() === 'en' ? '🎉 Completed' : '🎉 تکمیل شده' }}
                            @endif
                        </span>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-400 dark:text-gray-500">
                        {{ $booking->created_at->format('Y-m-d') }}
                    </td>
                    <td class="py-4 px-4">
                        @if($booking->whatsapp_number)
                        <a href="https://wa.me/{{ $booking->whatsapp_number }}" target="_blank"
                           class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($bookings->hasPages())
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">{{ $bookings->links() }}</div>
    @endif
</div>
@else
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-12 text-center">
    <div class="text-5xl mb-4">🧳</div>
    <h3 class="text-xl font-black text-gray-600 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'No Bookings Yet' : 'هیچ رزروی ندارید' }}</h3>
    <p class="text-gray-400 dark:text-gray-500 mb-6">{{ app()->getLocale() === 'en' ? 'Start your first journey with Afghan Quest' : 'اولین سفر خود را با افغان کویست آغاز کنید' }}</p>
    <a href="{{ route('packages.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors inline-block">
        {{ app()->getLocale() === 'en' ? 'View Tours' : 'مشاهده تورها' }}
    </a>
</div>
@endif

@endsection
