<?php

namespace App\Http\Controllers\HotelOwner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with(['province', 'rooms'])
            ->where('user_id', auth()->id())
            ->get();

        $totalHotels = $hotels->count();
        $totalRooms = Room::whereIn('hotel_id', $hotels->pluck('id'))->count();
        $totalBookings = Booking::whereIn('hotel_id', $hotels->pluck('id'))->count();
        $pendingBookings = Booking::whereIn('hotel_id', $hotels->pluck('id'))
            ->where('status', 'pending')->count();

        $recentBookings = Booking::with(['user', 'hotel', 'room'])
            ->whereIn('hotel_id', $hotels->pluck('id'))
            ->latest()
            ->take(10)
            ->get();

        return view('hotel-owner.dashboard', compact(
            'hotels', 'totalHotels', 'totalRooms',
            'totalBookings', 'pendingBookings', 'recentBookings'
        ));
    }

    public function hotels()
    {
        $hotels = Hotel::with(['province', 'rooms'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('hotel-owner.hotels.index', compact('hotels'));
    }

    public function createHotel()
    {
        return view('hotel-owner.hotels.create');
    }

    public function storeHotel(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
        ], [
            'featured_image.required' => 'لطفاً تصویر هتل را انتخاب کنید.',
        ]);

        $featuredPath = $request->file('featured_image')->store('hotels', 'public');

        Hotel::create([
            'user_id' => auth()->id(),
            'province_id' => $request->province_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
            'is_approved' => false,
            'is_active' => true,
        ]);

        return redirect()->route('hotel_owner.hotels.index')
            ->with('success', '✅ هتل شما ثبت شد و پس از تایید مدیر نمایش داده خواهد شد.');
    }

    public function editHotel(Hotel $hotel)
    {
        if ($hotel->user_id !== auth()->id()) { abort(403); }
        return view('hotel-owner.hotels.edit', compact('hotel'));
    }

    public function updateHotel(Request $request, Hotel $hotel)
    {
        if ($hotel->user_id !== auth()->id()) { abort(403); }

        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($hotel->featured_image && \Storage::disk('public')->exists($hotel->featured_image)) {
                \Storage::disk('public')->delete($hotel->featured_image);
            }
            $featuredPath = $request->file('featured_image')->store('hotels', 'public');
        } else {
            $featuredPath = $hotel->featured_image;
        }

        $hotel->update([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
        ]);

        return redirect()->route('hotel_owner.hotels.index')
            ->with('success', '✅ هتل با موفقیت بروزرسانی شد.');
    }

    public function rooms(Hotel $hotel)
    {
        if ($hotel->user_id !== auth()->id()) { abort(403); }
        $rooms = Room::where('hotel_id', $hotel->id)->get();
        return view('hotel-owner.rooms.index', compact('hotel', 'rooms'));
    }

    public function storeRoom(Request $request, Hotel $hotel)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'room_type_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'total_rooms' => 'required|integer|min:1',
        ]);

        Room::create([
            'hotel_id' => $hotel->id,
            'room_type' => $request->room_type,
            'room_type_en' => $request->room_type_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'price_per_night' => $request->price_per_night,
            'capacity' => $request->capacity,
            'total_rooms' => $request->total_rooms,
            'available_rooms' => $request->total_rooms,
            'is_active' => true,
        ]);

        return back()->with('success', '✅ اتاق جدید اضافه شد.');
    }

    public function updateRoom(Request $request, Hotel $hotel, Room $room)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'room_type_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'total_rooms' => 'required|integer|min:1',
            'available_rooms' => 'required|integer|min:0',
        ]);

        $room->update([
            'room_type' => $request->room_type,
            'room_type_en' => $request->room_type_en,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'price_per_night' => $request->price_per_night,
            'capacity' => $request->capacity,
            'total_rooms' => $request->total_rooms,
            'available_rooms' => $request->available_rooms,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', '✅ اتاق بروزرسانی شد.');
    }

    public function destroyRoom(Hotel $hotel, Room $room)
    {
        $room->delete();
        return back()->with('success', '✅ اتاق حذف شد.');
    }

    public function bookings()
    {
        $hotelIds = Hotel::where('user_id', auth()->id())->pluck('id');
        $bookings = Booking::with(['user', 'hotel', 'room'])
            ->whereIn('hotel_id', $hotelIds)
            ->latest()
            ->paginate(20);
        return view('hotel-owner.bookings', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $hotel = Hotel::find($booking->hotel_id);
        if ($hotel->user_id !== auth()->id()) { abort(403); }
        $booking->update(['status' => $request->status]);
        return back()->with('success', '✅ وضعیت رزرو بروزرسانی شد.');
    }
}
