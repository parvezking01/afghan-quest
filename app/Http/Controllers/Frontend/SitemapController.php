<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;

class SitemapController extends Controller
{
    public function index()
    {
        $provinces = Province::where('is_active', true)->get();
        $destinations = Destination::where('is_active', true)->get();
        $hotels = Hotel::where('is_approved', true)->where('is_active', true)->get();
        $packages = Package::where('is_active', true)->get();

        return response()->view('sitemap', compact('provinces', 'destinations', 'hotels', 'packages'))
            ->header('Content-Type', 'text/xml');
    }
}