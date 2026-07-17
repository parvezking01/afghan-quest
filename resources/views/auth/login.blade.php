@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Login' : 'ورود')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
        <div class="absolute inset-0 hero-pattern opacity-30"></div>

        <div class="relative z-10 w-full max-w-md">
            <div class="glass-white rounded-3xl p-8 shadow-2xl" data-aos="fade-up">
                <div class="text-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Afghan Quest Logo" class="h-24 w-auto inline-block">

                    <h2 class="text-3xl font-black gradient-text mt-4">
                        {{ app()->getLocale() === 'en' ? 'Login to Account' : 'ورود به حساب' }}</h2>
                    <p class="text-gray-500 mt-2">
                        {{ app()->getLocale() === 'en' ? 'Welcome to Afghan Quest' : 'به افغان کویست خوش آمدید' }}</p>
                </div>

                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-4 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="mb-4">
                        <label
                            class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Email' : 'ایمیل' }}</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="email" id="login_email"
                                class="w-full pr-10 pl-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all"
                                required autocomplete="off"
                                placeholder="{{ app()->getLocale() === 'en' ? 'your@email.com' : 'your@email.com' }}">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label
                            class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Password' : 'رمز عبور' }}</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" name="password" id="login_password"
                                class="w-full pr-10 pl-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all"
                                required autocomplete="off" placeholder="••••••••">
                            <button type="button" onclick="togglePassword()"
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i id="eyeIcon" class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="text-left mb-4">
                        <a href="{{ route('password.request') }}" class="text-sm text-primary-500 hover:underline">
                            {{ app()->getLocale() === 'en' ? 'Forgot Password?' : 'رمز عبور را فراموش کردید؟' }}
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full gradient-btn text-white py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all">
                        <i class="fas fa-sign-in-alt ms-2"></i> {{ app()->getLocale() === 'en' ? 'Login' : 'ورود' }}
                    </button>
                </form>

                <p class="text-center mt-6 text-gray-500">
                    {{ app()->getLocale() === 'en' ? "Don't have an account?" : 'حساب ندارید؟' }}
                    <a href="{{ route('register') }}" class="text-primary-500 font-bold hover:underline">
                        {{ app()->getLocale() === 'en' ? 'Register' : 'ثبت نام کنید' }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('login_password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

@endsection
