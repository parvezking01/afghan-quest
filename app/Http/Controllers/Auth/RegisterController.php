<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'whatsapp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:tourist,hotel_owner'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_approved' => $request->role === 'tourist',
            'is_active' => true,
        ]);

        if ($request->role === 'hotel_owner') {
            return redirect()->route('login')
                ->with('success', 'ثبت نام موفقیت‌آمیز بود. پس از تایید مدیر، می‌توانید وارد شوید.');
        }

        auth()->login($user);
        return redirect()->route('tourist.dashboard');
    }
}
