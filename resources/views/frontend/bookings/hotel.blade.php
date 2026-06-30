@extends('layouts.app')

@section('title', 'رزرو هتل: ' . $hotel->name)

@section('content')

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl font-black text-gray-800 mb-6">📋 فرم رزرو هتل</h2>

            <div class="bg-blue-50 rounded-xl p-4 mb-6">
                <h5 class="font-bold text-blue-700">{{ $hotel->name }}</h5>
                <p class="text-sm text-blue-600">{{ $hotel->address }}</p>
            </div>

            <form action="{{ route('booking.hotel.store') }}" method="POST">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">نام کامل *</label>
                    <input type="text" name="guest_name" value="{{ auth()->user()->name ?? old('guest_name') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">شماره واتساپ *</label>
                    <input type="text" name="whatsapp_number" value="{{ auth()->user()->whatsapp ?? auth()->user()->phone ?? old('whatsapp_number') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left" dir="ltr" placeholder="+93 700 000 000" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">نوع اتاق *</label>
                    <select name="room_id" id="roomSelect" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="calculateTotal()">
                        <option value="">-- انتخاب اتاق --</option>
                        @foreach($hotel->rooms as $room)
                        <option value="{{ $room->id }}"
                                data-price="{{ $room->price_per_night }}"
                                data-available="{{ $room->available_rooms }}">
                            {{ $room->room_type }} - {{ number_format($room->price_per_night) }} اف/شب ({{ $room->available_rooms }} موجود)
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تاریخ ورود *</label>
                        <input type="date" name="check_in_date" id="checkInDate" value="{{ old('check_in_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="calculateTotal()">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تاریخ خروج *</label>
                        <input type="date" name="check_out_date" id="checkOutDate" value="{{ old('check_out_date', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="calculateTotal()">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">تعداد اتاق *</label>
                    <input type="number" name="number_of_rooms" id="numberOfRooms" value="{{ old('number_of_rooms', 1) }}" min="1" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="calculateTotal()">
                    <p class="text-xs text-gray-400 mt-1" id="availabilityMessage"></p>
                </div>

                <!-- Price Display -->
                <div class="bg-gray-50 rounded-xl p-4 mb-4" id="priceDisplay" style="display:none;">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">قیمت هر شب:</span>
                        <span class="font-bold" id="pricePerNight">0 اف</span>
                    </div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">تعداد شب:</span>
                        <span class="font-bold" id="totalNights">0 شب</span>
                    </div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">تعداد اتاق:</span>
                        <span class="font-bold" id="roomCount">0</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between text-lg">
                        <span class="font-bold text-gray-700">💰 مبلغ کل:</span>
                        <span class="font-black text-green-600 text-xl" id="totalPrice">0 اف</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">پیام (اختیاری)</label>
                    <textarea name="guest_message" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="توضیحات یا سوالات خود را بنویسید...">{{ old('guest_message') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-600 transition-all shadow-lg">
                    <i class="fab fa-whatsapp ms-1"></i> ثبت و ارسال به واتساپ
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    function calculateTotal() {
        const roomSelect = document.getElementById('roomSelect');
        const checkIn = document.getElementById('checkInDate').value;
        const checkOut = document.getElementById('checkOutDate').value;
        const numberOfRooms = parseInt(document.getElementById('numberOfRooms').value) || 1;
        const priceDisplay = document.getElementById('priceDisplay');
        const availabilityMessage = document.getElementById('availabilityMessage');

        if (!roomSelect.value || !checkIn || !checkOut) {
            priceDisplay.style.display = 'none';
            return;
        }

        const selectedOption = roomSelect.options[roomSelect.selectedIndex];
        const pricePerNight = parseInt(selectedOption.dataset.price);
        const availableRooms = parseInt(selectedOption.dataset.available);

        // Check availability
        if (numberOfRooms > availableRooms) {
            availabilityMessage.innerHTML = '<span class="text-red-500">❌ فقط ' + availableRooms + ' اتاق موجود است!</span>';
            document.getElementById('numberOfRooms').value = availableRooms;
            return;
        } else {
            availabilityMessage.innerHTML = '<span class="text-green-500">✅ ' + availableRooms + ' اتاق موجود است</span>';
        }

        // Calculate nights
        const date1 = new Date(checkIn);
        const date2 = new Date(checkOut);
        const nights = Math.max(1, Math.round((date2 - date1) / (1000 * 60 * 60 * 24)));

        // Calculate total
        const total = pricePerNight * numberOfRooms * nights;

        // Update display
        document.getElementById('pricePerNight').textContent = pricePerNight.toLocaleString() + ' اف';
        document.getElementById('totalNights').textContent = nights + ' شب';
        document.getElementById('roomCount').textContent = numberOfRooms;
        document.getElementById('totalPrice').textContent = total.toLocaleString() + ' اف';

        priceDisplay.style.display = 'block';
    }

    // Calculate on page load
    document.addEventListener('DOMContentLoaded', function() {
        calculateTotal();
    });
</script>

@endsection
