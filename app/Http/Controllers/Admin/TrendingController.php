<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Http\Request;

class TrendingController extends Controller
{
    public function index()
    {
        $provinces = Province::orderBy('name')->get();
        $destinations = Destination::with('province')->orderBy('name')->get();
        $hotels = Hotel::with('province')->where('is_approved', true)->orderBy('name')->get();
        $packages = Package::orderBy('name')->get();

        return view('admin.trending.index', compact('provinces', 'destinations', 'hotels', 'packages'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:province,destination,hotel,package',
            'id' => 'required|integer',
        ]);

        $model = match($request->type) {
            'province' => Province::findOrFail($request->id),
            'destination' => Destination::findOrFail($request->id),
            'hotel' => Hotel::findOrFail($request->id),
            'package' => Package::findOrFail($request->id),
        };

        $model->update(['is_trending' => !$model->is_trending]);

        $status = $model->is_trending ? '✅ پرطرفدار شد' : '❌ از پرطرفدارها حذف شد';
        return back()->with('success', "{$status}.");
    }
}
