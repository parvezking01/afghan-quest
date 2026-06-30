<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.profile');
        } elseif ($user->isHotelOwner()) {
            return view('hotel-owner.profile');
        } else {
            return view('tourist.profile');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
        ]);

        auth()->user()->update($request->only(['name', 'phone', 'whatsapp']));

        return back()->with('success', '✅ پروفایل با موفقیت بروزرسانی شد.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', '❌ رمز عبور فعلی اشتباه است.');
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', '✅ رمز عبور با موفقیت تغییر کرد.');
    }
}
