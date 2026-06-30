<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('province')
            ->where('is_active', true)
            ->orderBy('display_order')
            ->paginate(12);

        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::with(['province', 'hotels' => function($query) {
            $query->where('is_approved', true)->where('is_active', true);
        }])
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

        $relatedDestinations = Destination::where('province_id', $destination->province_id)
            ->where('id', '!=', $destination->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('frontend.destinations.show', compact('destination', 'relatedDestinations'));
    }
}
