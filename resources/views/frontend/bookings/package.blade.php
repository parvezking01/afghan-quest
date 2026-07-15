@extends('layouts.app')

@section('title', 'رزرو پکیج: ' . $package->name)

@section('content')

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h2 class="text-2xl font-black text-gray-800 mb-6">📋 فرم رزرو پکیج</h2>

            <div class="bg-blue-50 rounded-xl p-4 mb-6">
                <h5 class="font-bold text-blue-700">{{ $package->name }}</h5>
                <p class="text-sm text-blue-600">{{ $package->duration_days }} روز / {{ $package->duration_nights }} شب | {{ number_format($package->final_price) }} اف</p>
            </div>

            <form action="{{ route('booking.package.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">نام کامل *</label>
                    <input type="text" name="guest_name" value="{{ auth()->user()->name ?? old('guest_name') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">شماره واتساپ *</label>
                    <input type="text" name="whatsapp_number" value="{{ auth()->user()->whatsapp ?? auth()->user()->phone ?? old('whatsapp_number') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left" dir="ltr" placeholder="+93 700 000 000" required>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تاریخ سفر *</label>
                        <input type="date" name="travel_date" value="{{ old('travel_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تعداد نفرات *</label>
                        <input type="number" name="number_of_travelers" value="{{ old('number_of_travelers', 1) }}" min="1" max="{{ $package->max_travelers }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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

@endsection
