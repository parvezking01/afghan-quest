@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Forgot Password' : 'فراموشی رمز عبور')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
        <div class="relative z-10 w-full max-w-md">
            <div class="glass-white rounded-3xl p-8 shadow-2xl" data-aos="fade-up">
                <div class="text-center mb-8">
                    <span class="text-5xl animate-float inline-block">🔒</span>
                    <h2 class="text-3xl font-black gradient-text mt-4">
                        {{ app()->getLocale() === 'en' ? 'Forgot Password' : 'فراموشی رمز عبور' }}</h2>
                    <p class="text-gray-500 mt-2">
                        {{ app()->getLocale() === 'en' ? 'Enter your email to receive a reset link' : 'ایمیل خود را وارد کنید تا لینک بازنشانی دریافت کنید' }}
                    </p>
                </div>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-6">
                        <label
                            class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Email' : 'ایمیل' }}</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="your@email.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full gradient-btn text-white py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all">
                        <i class="fas fa-paper-plane ms-2"></i>
                        {{ app()->getLocale() === 'en' ? 'Send Reset Link' : 'ارسال لینک بازنشانی' }}
                    </button>
                </form>

                <p class="text-center mt-6 text-gray-500">
                    <a href="{{ route('login') }}"
                        class="text-primary-500 font-bold hover:underline">{{ app()->getLocale() === 'en' ? 'Back to Login' : 'بازگشت به ورود' }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
