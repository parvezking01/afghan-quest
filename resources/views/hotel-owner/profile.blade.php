@extends('layouts.hotel-owner')

@section('title', 'تنظیمات پروفایل')
@section('page_title', 'تنظیمات پروفایل')
@section('page_subtitle', 'مدیریت اطلاعات حساب')

@section('content')

<div class="max-w-3xl mx-auto">
    <!-- Profile Info -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
        <h3 class="text-lg font-black text-gray-800 mb-6">👤 اطلاعات شخصی</h3>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">نام کامل *</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">ایمیل</label>
                    <input type="email" value="{{ auth()->user()->email }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500" disabled>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">شماره تماس *</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left" dir="ltr" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">شماره واتساپ *</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', auth()->user()->whatsapp) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 text-left" dir="ltr" required>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
                <i class="fas fa-save ms-1"></i> بروزرسانی اطلاعات
            </button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <h3 class="text-lg font-black text-gray-800 mb-6">🔒 تغییر رمز عبور</h3>

        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">رمز عبور فعلی *</label>
                    <input type="password" name="current_password"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div></div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">رمز عبور جدید *</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">تکرار رمز عبور جدید *</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <button type="submit" class="bg-amber-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-amber-600 transition-colors">
                <i class="fas fa-lock ms-1"></i> تغییر رمز عبور
            </button>
        </form>
    </div>
</div>

@endsection
