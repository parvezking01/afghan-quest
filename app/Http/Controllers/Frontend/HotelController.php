<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('province')
            ->where('is_approved', true)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->paginate(12);

        return view('frontend.hotels.index', compact('hotels'));
    }

    public function show($slug)
    {
        $hotel = Hotel::with(['province', 'rooms' => function($query) {
            $query->where('is_active', true);
        }])
        ->where('slug', $slug)
        ->where('is_approved', true)
        ->firstOrFail();

        return view('frontend.hotels.show', compact('hotel'));
    }
}
