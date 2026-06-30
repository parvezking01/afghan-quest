<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $locale = app()->getLocale();

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', $locale === 'en' ? '✅ Reset link sent to your email!' : '✅ لینک بازنشانی به ایمیل شما ارسال شد!')
            : back()->with('error', $locale === 'en' ? '❌ Error sending reset link.' : '❌ خطا در ارسال لینک بازنشانی.');
    }
}