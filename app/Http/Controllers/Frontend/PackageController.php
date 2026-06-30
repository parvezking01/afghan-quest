<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
            ->orderBy('display_order')
            ->paginate(9);

        return view('frontend.packages.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = Package::with('destinations.province')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.packages.show', compact('package'));
    }
}
