@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Reset Password' : 'بازنشانی رمز عبور')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
        <div class="relative z-10 w-full max-w-md">
            <div class="glass-white rounded-3xl p-8 shadow-2xl" data-aos="fade-up">
                <div class="text-center mb-8">
                    <span class="text-5xl animate-float inline-block">🔑</span>
                    <h2 class="text-3xl font-black gradient-text mt-4">
                        {{ app()->getLocale() === 'en' ? 'Reset Password' : 'بازنشانی رمز عبور' }}</h2>
                    <p class="text-gray-500 mt-2">
                        {{ app()->getLocale() === 'en' ? 'Enter your new password' : 'رمز عبور جدید را وارد کنید' }}</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4">
                        <label
                            class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'New Password' : 'رمز عبور جدید' }}</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-6">
                        <label
                            class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Confirm Password' : 'تکرار رمز عبور' }}</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full gradient-btn text-white py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all">
                        <i class="fas fa-save ms-2"></i>
                        {{ app()->getLocale() === 'en' ? 'Reset Password' : 'بازنشانی رمز عبور' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
