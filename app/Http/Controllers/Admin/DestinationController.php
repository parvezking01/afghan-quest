<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('province')
            ->orderBy('display_order')
            ->paginate(20);

        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $provinces = Province::where('is_active', true)->orderBy('name')->get();
        return view('admin.destinations.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'difficulty_level' => 'required|in:easy,moderate,challenging',
            'highlights' => 'nullable|string',
            'best_season' => 'nullable|string',
            'estimated_visit_duration' => 'nullable|string',
            'is_trending' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ], [
            'featured_image.required' => 'لطفاً تصویر شاخص مقصد را انتخاب کنید.',
            'province_id.required' => 'لطفاً ولایت مربوطه را انتخاب کنید.',
            'name.required' => 'نام مقصد الزامی است.',
            'description.required' => 'توضیحات مقصد الزامی است.',
        ]);

        $featuredPath = $request->file('featured_image')->store('destinations', 'public');

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('destinations/gallery', 'public');
            }
        }

        Destination::create([
            'province_id' => $request->province_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'difficulty_level' => $request->difficulty_level,
            'highlights' => $request->highlights,
            'best_season' => $request->best_season,
            'estimated_visit_duration' => $request->estimated_visit_duration,
            'is_trending' => $request->has('is_trending'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()->route('admin.destinations.index')
            ->with('success', '✅ مقصد جدید با موفقیت اضافه شد.');
    }

    public function edit(Destination $destination)
    {
        $provinces = Province::where('is_active', true)->orderBy('name')->get();
        return view('admin.destinations.edit', compact('destination', 'provinces'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'difficulty_level' => 'required|in:easy,moderate,challenging',
            'highlights' => 'nullable|string',
            'best_season' => 'nullable|string',
            'estimated_visit_duration' => 'nullable|string',
            'is_trending' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($destination->featured_image && \Storage::disk('public')->exists($destination->featured_image)) {
                \Storage::disk('public')->delete($destination->featured_image);
            }
            $featuredPath = $request->file('featured_image')->store('destinations', 'public');
        } else {
            $featuredPath = $destination->featured_image;
        }

        $galleryPaths = $destination->gallery_images ? json_decode($destination->gallery_images, true) : [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('destinations/gallery', 'public');
            }
        }

        $destination->update([
            'province_id' => $request->province_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'difficulty_level' => $request->difficulty_level,
            'highlights' => $request->highlights,
            'best_season' => $request->best_season,
            'estimated_visit_duration' => $request->estimated_visit_duration,
            'is_trending' => $request->has('is_trending'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()->route('admin.destinations.index')
            ->with('success', '✅ مقصد با موفقیت بروزرسانی شد.');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->featured_image && \Storage::disk('public')->exists($destination->featured_image)) {
            \Storage::disk('public')->delete($destination->featured_image);
        }
        if ($destination->gallery_images) {
            foreach (json_decode($destination->gallery_images) as $image) {
                if (\Storage::disk('public')->exists($image)) {
                    \Storage::disk('public')->delete($image);
                }
            }
        }
        $destination->delete();
        return redirect()->route('admin.destinations.index')
            ->with('success', '✅ مقصد با موفقیت حذف شد.');
    }
}
