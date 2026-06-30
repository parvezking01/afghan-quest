@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Register' : 'ثبت نام')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="absolute inset-0 hero-pattern opacity-30"></div>

    <div class="relative z-10 w-full max-w-lg">
        <div class="glass-white rounded-3xl p-8 shadow-2xl" data-aos="fade-up">
            <div class="text-center mb-8">
                <span class="text-5xl animate-float inline-block">🏔️</span>
                <h2 class="text-3xl font-black gradient-text mt-4">{{ app()->getLocale() === 'en' ? 'Create Account' : 'ثبت نام' }}</h2>
                <p class="text-gray-500 mt-2">{{ app()->getLocale() === 'en' ? 'Join the Afghan Quest family' : 'به خانواده افغان کویست بپیوندید' }}</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-4 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Full Name' : 'نام کامل' }}</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all"
                               required autocomplete="off" placeholder="{{ app()->getLocale() === 'en' ? 'Ahmad Mohammadi' : 'احمد محمدی' }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Email' : 'ایمیل' }}</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all"
                               required autocomplete="off" placeholder="your@email.com">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Phone Number' : 'شماره تماس' }}</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all"
                               required autocomplete="off" placeholder="+93 700 000 000">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'WhatsApp Number' : 'شماره واتساپ' }}</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all"
                               required autocomplete="off" placeholder="+93 700 000 000">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Account Type' : 'نوع حساب' }}</label>
                    <select name="role" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all" required>
                        <option value="tourist">{{ app()->getLocale() === 'en' ? '🧳 Tourist' : '🧳 گردشگر' }}</option>
                        <option value="hotel_owner">{{ app()->getLocale() === 'en' ? '🏨 Hotel Owner' : '🏨 مالک هتل' }}</option>
                    </select>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Password' : 'رمز عبور' }}</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all"
                                   required autocomplete="new-password" placeholder="{{ app()->getLocale() === 'en' ? 'Min 8 characters' : 'حداقل ۸ کاراکتر' }}">
                            <button type="button" onclick="togglePassword('password', 'eye1')" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i id="eye1" class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">{{ app()->getLocale() === 'en' ? 'Confirm Password' : 'تکرار رمز عبور' }}</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 transition-all"
                                   required autocomplete="new-password" placeholder="{{ app()->getLocale() === 'en' ? 'Repeat password' : 'تکرار رمز عبور' }}">
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye2')" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i id="eye2" class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full gradient-gold text-primary-900 py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all mt-4">
                    <i class="fas fa-user-plus ms-2"></i> {{ app()->getLocale() === 'en' ? 'Register' : 'ثبت نام' }}
                </button>
            </form>

            <p class="text-center mt-6 text-gray-500">
                {{ app()->getLocale() === 'en' ? 'Already have an account?' : 'حساب دارید؟' }}
                <a href="{{ route('login') }}" class="text-primary-500 font-bold hover:underline">
                    {{ app()->getLocale() === 'en' ? 'Login' : 'وارد شوید' }}
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

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
