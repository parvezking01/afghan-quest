<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::withCount(['destinations', 'hotels'])
            ->orderBy('display_order')
            ->paginate(20);

        return view('admin.provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('admin.provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'history' => 'nullable|string',
            'culture' => 'nullable|string',
            'best_time_to_visit' => 'nullable|string',
            'local_food' => 'nullable|string',
            'transportation_info' => 'nullable|string',
            'safety_level' => 'required|in:safe,moderate,caution',
            'is_trending' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ], [
            'featured_image.required' => 'لطفاً تصویر شاخص ولایت را انتخاب کنید.',
            'featured_image.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'featured_image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'name.required' => 'نام ولایت الزامی است.',
            'description.required' => 'توضیحات ولایت الزامی است.',
            'safety_level.required' => 'سطح امنیت را انتخاب کنید.',
        ]);

        $featuredPath = $request->file('featured_image')->store('provinces', 'public');

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('provinces/gallery', 'public');
            }
        }

        Province::create([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'history' => $request->history,
            'culture' => $request->culture,
            'best_time_to_visit' => $request->best_time_to_visit,
            'local_food' => $request->local_food,
            'transportation_info' => $request->transportation_info,
            'safety_level' => $request->safety_level,
            'is_trending' => $request->has('is_trending'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()->route('admin.provinces.index')
            ->with('success', '✅ ولایت جدید با موفقیت اضافه شد.');
    }

    public function edit(Province $province)
    {
        return view('admin.provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'history' => 'nullable|string',
            'culture' => 'nullable|string',
            'best_time_to_visit' => 'nullable|string',
            'local_food' => 'nullable|string',
            'transportation_info' => 'nullable|string',
            'safety_level' => 'required|in:safe,moderate,caution',
            'is_trending' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ], [
            'featured_image.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'featured_image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'name.required' => 'نام ولایت الزامی است.',
            'description.required' => 'توضیحات ولایت الزامی است.',
            'safety_level.required' => 'سطح امنیت را انتخاب کنید.',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($province->featured_image && \Storage::disk('public')->exists($province->featured_image)) {
                \Storage::disk('public')->delete($province->featured_image);
            }
            $featuredPath = $request->file('featured_image')->store('provinces', 'public');
        } else {
            $featuredPath = $province->featured_image;
        }

        $galleryPaths = $province->gallery_images ? json_decode($province->gallery_images, true) : [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('provinces/gallery', 'public');
            }
        }

        $province->update([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'history' => $request->history,
            'culture' => $request->culture,
            'best_time_to_visit' => $request->best_time_to_visit,
            'local_food' => $request->local_food,
            'transportation_info' => $request->transportation_info,
            'safety_level' => $request->safety_level,
            'is_trending' => $request->has('is_trending'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()->route('admin.provinces.index')
            ->with('success', '✅ ولایت با موفقیت بروزرسانی شد.');
    }

    public function destroy(Province $province)
    {
        if ($province->featured_image && \Storage::disk('public')->exists($province->featured_image)) {
            \Storage::disk('public')->delete($province->featured_image);
        }
        if ($province->gallery_images) {
            foreach (json_decode($province->gallery_images) as $image) {
                if (\Storage::disk('public')->exists($image)) {
                    \Storage::disk('public')->delete($image);
                }
            }
        }
        $province->delete();
        return redirect()->route('admin.provinces.index')
            ->with('success', '✅ ولایت با موفقیت حذف شد.');
    }
}
