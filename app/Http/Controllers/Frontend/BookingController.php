<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function createPackageBooking($slug)
    {
        $package = Package::with('destinations.province')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.bookings.package', compact('package'));
    }

    public function storePackageBooking(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'guest_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'travel_date' => 'required|date|after_or_equal:today',
            'number_of_travelers' => 'required|integer|min:1',
            'guest_message' => 'nullable|string|max:1000',
        ]);

        $package = Package::findOrFail($request->package_id);
        $locale = app()->getLocale();

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'booking_type' => 'package',
            'booking_number' => 'AQ-' . strtoupper(Str::random(8)),
            'guest_name' => $request->guest_name,
            'whatsapp_number' => $request->whatsapp_number,
            'travel_date' => $request->travel_date,
            'number_of_travelers' => $request->number_of_travelers,
            'total_amount' => $package->final_price * $request->number_of_travelers,
            'guest_message' => $request->guest_message,
            'status' => 'pending',
        ]);

        // Bilingual WhatsApp message
        $whatsappNumber = $package->whatsapp ?? '93700000000';

        if ($locale === 'en') {
            $message = urlencode(
                "🔔 *New Booking*\n\n" .
                "📦 Tour: {$package->name}\n" .
                "👤 Guest: {$request->guest_name}\n" .
                "📱 Phone: {$request->whatsapp_number}\n" .
                "📅 Date: {$request->travel_date}\n" .
                "👥 Travelers: {$request->number_of_travelers} people\n" .
                "💰 Amount: " . number_format($booking->total_amount) . " AFN\n" .
                "🔢 Booking Code: {$booking->booking_number}\n\n" .
                "📝 Message: {$request->guest_message}\n\n" .
                "_Please reply to confirm_"
            );
        } else {
            $message = urlencode(
                "🔔 *رزرو جدید*\n\n" .
                "📦 تور: {$package->name}\n" .
                "👤 مهمان: {$request->guest_name}\n" .
                "📱 شماره: {$request->whatsapp_number}\n" .
                "📅 تاریخ: {$request->travel_date}\n" .
                "👥 تعداد: {$request->number_of_travelers} نفر\n" .
                "💰 مبلغ: " . number_format($booking->total_amount) . " افغانی\n" .
                "🔢 کد رزرو: {$booking->booking_number}\n\n" .
                "📝 پیام: {$request->guest_message}\n\n" .
                "_لطفاً برای تایید پاسخ دهید_"
            );
        }

        return redirect()->away("https://wa.me/{$whatsappNumber}?text={$message}");
    }

    public function createHotelBooking($slug)
    {
        $hotel = Hotel::with(['rooms' => function($query) {
            $query->where('is_active', true)->where('available_rooms', '>', 0);
        }, 'province'])
        ->where('slug', $slug)
        ->where('is_approved', true)
        ->firstOrFail();

        return view('frontend.bookings.hotel', compact('hotel'));
    }

    public function storeHotelBooking(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,id',
            'guest_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_rooms' => 'required|integer|min:1',
            'guest_message' => 'nullable|string|max:1000',
        ]);

        $room = \App\Models\Room::findOrFail($request->room_id);
        $hotel = Hotel::findOrFail($request->hotel_id);
        $locale = app()->getLocale();

        if ($room->available_rooms < $request->number_of_rooms) {
            $errorMsg = $locale === 'en' ? '❌ Not enough rooms available.' : '❌ اتاق کافی موجود نیست.';
            return back()->with('error', $errorMsg)->withInput();
        }

        $days = max(1, now()->parse($request->check_in_date)->diffInDays($request->check_out_date));
        $totalAmount = $room->price_per_night * $request->number_of_rooms * $days;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            'room_id' => $room->id,
            'booking_type' => 'hotel',
            'booking_number' => 'AQ-' . strtoupper(Str::random(8)),
            'guest_name' => $request->guest_name,
            'whatsapp_number' => $request->whatsapp_number,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'number_of_rooms' => $request->number_of_rooms,
            'total_amount' => $totalAmount,
            'guest_message' => $request->guest_message,
            'status' => 'pending',
        ]);

        $room->decrement('available_rooms', $request->number_of_rooms);

        // Bilingual WhatsApp message
        $whatsappNumber = $hotel->whatsapp ?? $hotel->phone;

        if ($locale === 'en') {
            $message = urlencode(
                "🔔 *New Hotel Booking*\n\n" .
                "🏨 Hotel: {$hotel->name}\n" .
                "👤 Guest: {$request->guest_name}\n" .
                "📱 Phone: {$request->whatsapp_number}\n" .
                "🛏️ Room: {$room->room_type}\n" .
                "📅 Check-in: {$request->check_in_date}\n" .
                "📅 Check-out: {$request->check_out_date}\n" .
                "🚪 Rooms: {$request->number_of_rooms}\n" .
                "💰 Amount: " . number_format($booking->total_amount) . " AFN\n" .
                "🔢 Booking Code: {$booking->booking_number}\n\n" .
                "📝 Message: {$request->guest_message}\n\n" .
                "_Please reply to confirm_"
            );
        } else {
            $message = urlencode(
                "🔔 *رزرو جدید هتل*\n\n" .
                "🏨 هتل: {$hotel->name}\n" .
                "👤 مهمان: {$request->guest_name}\n" .
                "📱 شماره: {$request->whatsapp_number}\n" .
                "🛏️ اتاق: {$room->room_type}\n" .
                "📅 ورود: {$request->check_in_date}\n" .
                "📅 خروج: {$request->check_out_date}\n" .
                "🚪 تعداد اتاق: {$request->number_of_rooms}\n" .
                "💰 مبلغ: " . number_format($booking->total_amount) . " افغانی\n" .
                "🔢 کد رزرو: {$booking->booking_number}\n\n" .
                "📝 پیام: {$request->guest_message}\n\n" .
                "_لطفاً برای تایید پاسخ دهید_"
            );
        }

        return redirect()->away("https://wa.me/{$whatsappNumber}?text={$message}");
    }

    public function confirmation($bookingNumber)
    {
        $booking = Booking::with(['package', 'hotel', 'room'])
            ->where('booking_number', $bookingNumber)
            ->firstOrFail();

        return view('frontend.bookings.confirmation', compact('booking'));
    }
}
