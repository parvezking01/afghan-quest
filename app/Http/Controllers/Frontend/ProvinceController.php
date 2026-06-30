<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::withCount(['destinations', 'hotels'])
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(12);

        return view('frontend.provinces.index', compact('provinces'));
    }

    public function show($slug)
    {
        $province = Province::with([
            'destinations' => function($query) {
                $query->where('is_active', true)->orderBy('display_order');
            },
            'hotels' => function($query) {
                $query->where('is_approved', true)->where('is_active', true);
            }
        ])
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

        return view('frontend.provinces.show', compact('province'));
    }
}
