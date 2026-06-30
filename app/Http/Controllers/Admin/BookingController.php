<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'package', 'hotel', 'room']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'package.destinations', 'hotel.province', 'room']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,confirmed,cancelled,completed',
        ]);

        $booking->update(['status' => $request->status]);

        $statusMessages = [
            'pending' => 'در انتظار',
            'contacted' => 'تماس گرفته شده',
            'confirmed' => 'تایید شده',
            'cancelled' => 'لغو شده',
            'completed' => 'تکمیل شده',
        ];

        $message = $statusMessages[$request->status] ?? $request->status;

        return back()->with('success', "✅ وضعیت رزرو به «{$message}» تغییر کرد.");
    }
}
