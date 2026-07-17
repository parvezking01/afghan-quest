@extends('layouts.tourist')

@section('title', app()->getLocale() === 'en' ? 'My Profile' : 'پروفایل من')

@section('content')

    <h2 class="text-2xl font-black text-gray-800 dark:text-white mb-6">👤
        {{ app()->getLocale() === 'en' ? 'My Profile' : 'پروفایل من' }}</h2>

    <div class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8 mb-6">
            <h3 class="text-lg font-black text-gray-800 dark:text-white mb-6">👤
                {{ app()->getLocale() === 'en' ? 'Personal Information' : 'اطلاعات شخصی' }}</h3>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'Full Name' : 'نام کامل' }}
                            *</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'Email' : 'ایمیل' }}</label>
                        <input type="email" value="{{ auth()->user()->email }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-400"
                            disabled>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            {{ app()->getLocale() === 'en' ? 'Email cannot be changed' : 'ایمیل قابل تغییر نیست' }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'Phone Number' : 'شماره تماس' }}
                            *</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-left"
                            dir="ltr" required>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'WhatsApp Number' : 'شماره واتساپ' }}
                            *</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', auth()->user()->whatsapp) }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 text-left"
                            dir="ltr" required>
                    </div>
                </div>

                <button type="submit"
                    class="bg-blue-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
                    <i class="fas fa-save ms-1"></i>
                    {{ app()->getLocale() === 'en' ? 'Update Profile' : 'بروزرسانی پروفایل' }}
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-8">
            <h3 class="text-lg font-black text-gray-800 dark:text-white mb-6">🔒
                {{ app()->getLocale() === 'en' ? 'Change Password' : 'تغییر رمز عبور' }}</h3>

            <form action="{{ route('profile.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'Current Password' : 'رمز عبور فعلی' }}
                            *</label>
                        <input type="password" name="current_password"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div></div>
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'New Password' : 'رمز عبور جدید' }}
                            *</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">{{ app()->getLocale() === 'en' ? 'Confirm New Password' : 'تکرار رمز عبور جدید' }}
                            *</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                </div>

                <button type="submit"
                    class="bg-amber-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-amber-600 transition-colors">
                    <i class="fas fa-lock ms-1"></i>
                    {{ app()->getLocale() === 'en' ? 'Change Password' : 'تغییر رمز عبور' }}
                </button>
            </form>
        </div>
    </div>

@endsection
