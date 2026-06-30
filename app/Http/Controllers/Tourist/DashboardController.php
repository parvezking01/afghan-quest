<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['package', 'hotel'])
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        $totalBookings = Booking::where('user_id', auth()->id())->count();
        $confirmedBookings = Booking::where('user_id', auth()->id())->where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('user_id', auth()->id())->where('status', 'pending')->count();

        return view('tourist.dashboard', compact('bookings', 'totalBookings', 'confirmedBookings', 'pendingBookings'));
    }

    public function bookings()
    {
        $bookings = Booking::with(['package', 'hotel'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('tourist.bookings', compact('bookings'));
    }

    public function profile()
    {
        return view('tourist.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        auth()->user()->update($request->only(['name', 'phone', 'whatsapp', 'address']));

        return back()->with('success', 'پروفایل با موفقیت بروزرسانی شد.');
    }
}
