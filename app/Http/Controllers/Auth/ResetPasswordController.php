<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        $locale = app()->getLocale();

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', $locale === 'en' ? '✅ Password reset successful! Please login.' : '✅ رمز عبور با موفقیت بازنشانی شد! وارد شوید.')
            : back()->with('error', $locale === 'en' ? '❌ Invalid token or email.' : '❌ توکن یا ایمیل نامعتبر است.');
    }
}