@extends('layouts.hotel-owner')

@section('title', 'مدیریت اتاق‌ها')
@section('page_title', 'اتاق‌های ' . $hotel->name)
@section('page_subtitle', 'مدیریت اتاق‌های این هتل')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500">کل: <span class="font-bold text-gray-700">{{ $rooms->count() }}</span> نوع اتاق</p>
    <button onclick="document.getElementById('addRoomForm').classList.toggle('hidden')" class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
        <i class="fas fa-plus ms-1"></i> افزودن اتاق جدید
    </button>
</div>

<!-- Add Room Form -->
<div id="addRoomForm" class="hidden bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
    <h4 class="font-bold text-gray-800 mb-4">افزودن اتاق جدید</h4>
    <form action="{{ route('hotel_owner.rooms.store', $hotel) }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">نوع اتاق *</label>
                <input type="text" name="room_type" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="مثال: یک نفره، دو نفره، سوئیت" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">قیمت هر شب (افغانی) *</label>
                <input type="number" name="price_per_night" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">ظرفیت (نفر) *</label>
                <input type="number" name="capacity" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">تعداد کل اتاق‌ها *</label>
                <input type="number" name="total_rooms" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold text-gray-700 mb-1">توضیحات</label>
            <textarea name="description" rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-600 transition-colors">
            <i class="fas fa-save ms-1"></i> ذخیره اتاق
        </button>
    </form>
</div>

<!-- Rooms List -->
<div class="space-y-4">
    @forelse($rooms as $room)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h5 class="text-lg font-bold text-gray-800">{{ $room->room_type }}</h5>
                @if($room->description)<p class="text-sm text-gray-500 mt-1">{{ $room->description }}</p>@endif
                <div class="flex gap-4 mt-2 text-sm text-gray-500">
                    <span><i class="fas fa-user ms-1"></i> ظرفیت: {{ $room->capacity }} نفر</span>
                    <span><i class="fas fa-door-open ms-1"></i> کل: {{ $room->total_rooms }} | موجود: {{ $room->available_rooms }}</span>
                    <span class="font-bold text-gray-700">{{ number_format($room->price_per_night) }} اف / شب</span>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="editRoom({{ $room->id }}, '{{ $room->room_type }}', {{ $room->price_per_night }}, {{ $room->capacity }}, {{ $room->total_rooms }}, {{ $room->available_rooms }}, '{{ $room->description }}')" class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-100">
                    <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('hotel_owner.rooms.destroy', ['hotel' => $hotel, 'room' => $room]) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-50 text-red-500 px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-100">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-16 bg-white rounded-2xl">
        <div class="text-5xl mb-4">🚪</div>
        <h3 class="text-lg font-bold text-gray-600">هیچ اتاقی ثبت نشده است</h3>
    </div>
    @endforelse
</div>

<a href="{{ route('hotel_owner.hotels.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 mt-6">
    <i class="fas fa-arrow-right"></i> بازگشت به هتل‌ها
</a>

@endsection
