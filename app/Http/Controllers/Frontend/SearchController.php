<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Province;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');

        $provinces = Province::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('name_en', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('description_en', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $destinations = Destination::with('province')
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('name_en', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('description_en', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $hotels = Hotel::with('province')
            ->where('is_approved', true)
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('name_en', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('description_en', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $packages = Package::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('name_en', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('description_en', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        return view('frontend.search', compact('provinces', 'destinations', 'hotels', 'packages', 'query'));
    }
}
