<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_provinces' => Province::count(),
            'total_destinations' => Destination::count(),
            'total_hotels' => Hotel::count(),
            'total_packages' => Package::count(),
            'total_users' => User::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'pending_hotels' => Hotel::where('is_approved', false)->count(),
            'pending_owners' => User::where('role', 'hotel_owner')->where('is_approved', false)->count(),

            // ✅ Revenue Calculations (Only calculating 'confirmed' bookings)
            'total_revenue' => Booking::where('status', 'confirmed')->sum('total_amount'),
            'monthly_revenue' => Booking::where('status', 'confirmed')
                                        ->whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->sum('total_amount'),

            'recent_bookings' => Booking::with('user')->latest()->take(5)->get(),
            'recent_users' => User::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
