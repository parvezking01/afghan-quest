<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Province;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $trendingProvinces = Province::where('is_trending', true)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->take(6)
            ->get();

        $trendingDestinations = Destination::with('province')
            ->where('is_trending', true)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->take(8)
            ->get();

        $trendingPackages = Package::where('is_trending', true)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->take(6)
            ->get();

        // REAL COUNTS FROM DATABASE
        $provincesCount = Province::where('is_active', true)->count();
        $destinationsCount = Destination::where('is_active', true)->count();
        $hotelsCount = Hotel::where('is_approved', true)->where('is_active', true)->count();
        $packagesCount = Package::where('is_active', true)->count();

        $provinces = Province::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('frontend.home', compact(
            'trendingProvinces',
            'trendingDestinations',
            'trendingPackages',
            'provincesCount',
            'destinationsCount',
            'hotelsCount',
            'packagesCount',
            'provinces'
        ));
    }
}
