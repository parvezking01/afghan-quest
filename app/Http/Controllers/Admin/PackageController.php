<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('destinations')->latest()->paginate(20);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();
        return view('admin.packages.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'type' => 'required|in:provincial,regional,thematic,custom',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'whatsapp' => 'required|string|max:20',
            'max_travelers' => 'required|integer|min:1',
            'includes_guide' => 'boolean',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'destinations' => 'nullable|array',
            'destinations.*' => 'exists:destinations,id',
            'is_trending' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ], [
            'featured_image.required' => 'لطفاً تصویر شاخص پکیج را انتخاب کنید.',
            'name.required' => 'نام پکیج الزامی است.',
            'price.required' => 'قیمت پکیج الزامی است.',
            'whatsapp.required' => 'شماره واتساپ برای رزرو الزامی است.',
        ]);

        $featuredPath = $request->file('featured_image')->store('packages', 'public');

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('packages/gallery', 'public');
            }
        }

        $includedServices = $request->included_services ? array_filter(explode("\n", str_replace("\r", "", $request->included_services))) : [];
        $excludedServices = $request->excluded_services ? array_filter(explode("\n", str_replace("\r", "", $request->excluded_services))) : [];
        $itinerary = $request->itinerary ? array_filter(explode("\n", str_replace("\r", "", $request->itinerary))) : [];

        $package = Package::create([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'type' => $request->type,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'whatsapp' => $request->whatsapp,
            'max_travelers' => $request->max_travelers,
            'includes_guide' => $request->has('includes_guide'),
            'included_services' => !empty($includedServices) ? json_encode(array_values($includedServices)) : null,
            'excluded_services' => !empty($excludedServices) ? json_encode(array_values($excludedServices)) : null,
            'itinerary' => !empty($itinerary) ? json_encode(array_values($itinerary)) : null,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'is_trending' => $request->has('is_trending'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        if ($request->has('destinations')) {
            $package->destinations()->sync($request->destinations);
        }

        return redirect()->route('admin.packages.index')
            ->with('success', '✅ پکیج جدید با موفقیت اضافه شد.');
    }

    public function edit(Package $package)
    {
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();
        return view('admin.packages.edit', compact('package', 'destinations'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'type' => 'required|in:provincial,regional,thematic,custom',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'whatsapp' => 'required|string|max:20',
            'max_travelers' => 'required|integer|min:1',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'destinations' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($package->featured_image && \Storage::disk('public')->exists($package->featured_image)) {
                \Storage::disk('public')->delete($package->featured_image);
            }
            $featuredPath = $request->file('featured_image')->store('packages', 'public');
        } else {
            $featuredPath = $package->featured_image;
        }

        $galleryPaths = $package->gallery_images ? json_decode($package->gallery_images, true) : [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('packages/gallery', 'public');
            }
        }

        $includedServices = $request->included_services ? array_filter(explode("\n", str_replace("\r", "", $request->included_services))) : [];
        $excludedServices = $request->excluded_services ? array_filter(explode("\n", str_replace("\r", "", $request->excluded_services))) : [];
        $itinerary = $request->itinerary ? array_filter(explode("\n", str_replace("\r", "", $request->itinerary))) : [];

        $package->update([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'type' => $request->type,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'whatsapp' => $request->whatsapp,
            'max_travelers' => $request->max_travelers,
            'includes_guide' => $request->has('includes_guide'),
            'included_services' => !empty($includedServices) ? json_encode(array_values($includedServices)) : $package->included_services,
            'excluded_services' => !empty($excludedServices) ? json_encode(array_values($excludedServices)) : $package->excluded_services,
            'itinerary' => !empty($itinerary) ? json_encode(array_values($itinerary)) : $package->itinerary,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : $package->gallery_images,
            'is_trending' => $request->has('is_trending'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        if ($request->has('destinations')) {
            $package->destinations()->sync($request->destinations);
        }

        return redirect()->route('admin.packages.index')
            ->with('success', '✅ پکیج با موفقیت بروزرسانی شد.');
    }

    public function destroy(Package $package)
    {
        if ($package->featured_image && \Storage::disk('public')->exists($package->featured_image)) {
            \Storage::disk('public')->delete($package->featured_image);
        }
        $package->destinations()->detach();
        $package->delete();
        return redirect()->route('admin.packages.index')
            ->with('success', '✅ پکیج با موفقیت حذف شد.');
    }
}
