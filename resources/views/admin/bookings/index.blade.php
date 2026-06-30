@extends('layouts.admin')

@section('title', 'مدیریت رزروها')
@section('page_title', 'مدیریت رزروها')
@section('page_subtitle', 'لیست تمام رزروهای سیستم')

@section('content')

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 text-center">
        <p class="text-2xl font-black text-gray-700 dark:text-white">{{ $totalBookings ?? \App\Models\Booking::count() }}</p>
        <p class="text-gray-400 dark:text-gray-500 text-xs">کل رزروها</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 text-center">
        <p class="text-2xl font-black text-yellow-600 dark:text-yellow-400">{{ $pendingCount ?? \App\Models\Booking::where('status', 'pending')->count() }}</p>
        <p class="text-gray-400 dark:text-gray-500 text-xs">⏳ در انتظار</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 text-center">
        <p class="text-2xl font-black text-blue-600 dark:text-blue-400">{{ $contactedCount ?? \App\Models\Booking::where('status', 'contacted')->count() }}</p>
        <p class="text-gray-400 dark:text-gray-500 text-xs">📞 تماس گرفته شده</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 text-center">
        <p class="text-2xl font-black text-green-600 dark:text-green-400">{{ $confirmedCount ?? \App\Models\Booking::where('status', 'confirmed')->count() }}</p>
        <p class="text-gray-400 dark:text-gray-500 text-xs">✅ تایید شده</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 text-center">
        <p class="text-2xl font-black text-red-500 dark:text-red-400">{{ $cancelledCount ?? \App\Models\Booking::where('status', 'cancelled')->count() }}</p>
        <p class="text-gray-400 dark:text-gray-500 text-xs">❌ لغو شده</p>
    </div>
</div>

<!-- Filter Tabs -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-4 mb-6">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.bookings.index') }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ !request('status') ? 'bg-gray-800 dark:bg-gray-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
            همه
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/30' }}">
            ⏳ در انتظار
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'contacted']) }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('status') === 'contacted' ? 'bg-blue-500 text-white' : 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/30' }}">
            📞 تماس گرفته شده
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('status') === 'confirmed' ? 'bg-green-500 text-white' : 'bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/30' }}">
            ✅ تایید شده
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request('status') === 'cancelled' ? 'bg-red-500 text-white' : 'bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/30' }}">
            ❌ لغو شده
        </a>
    </div>
</div>

<!-- Bookings Table -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">کد رزرو</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مهمان</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">نوع</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">جزئیات</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">تاریخ</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">مبلغ</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">وضعیت</th>
                    <th class="text-right py-4 px-3 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                    <td class="py-4 px-3">
                        <span class="text-sm font-mono font-bold text-gray-600 dark:text-gray-300">{{ $booking->booking_number }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $booking->guest_name ?? $booking->user->name ?? '-' }}</p>
                        <a href="https://wa.me/{{ $booking->whatsapp_number }}" target="_blank"
                           class="text-xs text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">
                            <i class="fab fa-whatsapp ms-1"></i> {{ $booking->whatsapp_number }}
                        </a>
                    </td>
                    <td class="py-4 px-3">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $booking->booking_type === 'package' ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' }}">
                            {{ $booking->booking_type === 'package' ? '📦 تور' : '🏨 هتل' }}
                        </span>
                    </td>
                    <td class="py-4 px-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ $booking->package->name ?? $booking->hotel->name ?? '-' }}
                        </p>
                        @if($booking->room)
                        <p class="text-xs text-gray-400 dark:text-gray-500">🛏️ {{ $booking->room->room_type }}</p>
                        @endif
                        @if($booking->travel_date)
                        <p class="text-xs text-gray-400 dark:text-gray-500">📅 سفر: {{ $booking->travel_date->format('Y-m-d') }}</p>
                        @endif
                        @if($booking->check_in_date)
                        <p class="text-xs text-gray-400 dark:text-gray-500">🏨 {{ $booking->check_in_date->format('Y-m-d') }} → {{ $booking->check_out_date?->format('Y-m-d') }}</p>
                        @endif
                        @if($booking->guest_message)
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">💬 {{ Str::limit($booking->guest_message, 50) }}</p>
                        @endif
                    </td>
                    <td class="py-4 px-3 text-sm text-gray-400 dark:text-gray-500">
                        {{ $booking->created_at->format('Y-m-d') }}
                    </td>
                    <td class="py-4 px-3 text-sm font-bold text-gray-700 dark:text-gray-200">
                        {{ number_format($booking->total_amount) }} اف
                    </td>
                    <td class="py-4 px-3">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' : '' }}
                            {{ $booking->status === 'contacted' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : '' }}">
                            @if($booking->status === 'pending') ⏳ در انتظار
                            @elseif($booking->status === 'contacted') 📞 تماس گرفته شده
                            @elseif($booking->status === 'confirmed') ✅ تایید شده
                            @elseif($booking->status === 'cancelled') ❌ لغو شده
                            @elseif($booking->status === 'completed') 🎉 تکمیل شده
                            @endif
                        </span>
                    </td>
                    <td class="py-4 px-3">
                        <div class="flex gap-1">
                            @if($booking->status === 'pending')
                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="contacted">
                                <button class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors" title="تماس گرفته شد">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors" title="تایید">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif

                            @if($booking->status === 'contacted')
                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors" title="تایید">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif

                            @if(in_array($booking->status, ['pending', 'contacted']))
                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button class="bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors" title="لغو">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif

                            @if($booking->status === 'confirmed')
                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button class="bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 p-2 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/50 transition-colors" title="تکمیل شد">
                                    <i class="fas fa-flag-checkered"></i>
                                </button>
                            </form>
                            @endif

                            <a href="https://wa.me/{{ $booking->whatsapp_number }}" target="_blank"
                               class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors" title="واتساپ">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-12 text-gray-400 dark:text-gray-500">
                        <div class="text-5xl mb-4">📋</div>
                        <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300">هیچ رزروی وجود ندارد</h3>
                    </td>
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
