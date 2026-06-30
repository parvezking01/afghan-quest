<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Province;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with(['province', 'owner'])
            ->latest()
            ->paginate(20);

        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $provinces = Province::where('is_active', true)->orderBy('name')->get();
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();
        $owners = User::where('role', 'hotel_owner')->where('is_approved', true)->get();

        return view('admin.hotels.create', compact('provinces', 'destinations', 'owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'province_id' => 'required|exists:provinces,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
            'languages_spoken' => 'nullable|string',
            'distance_from_city_center' => 'nullable|numeric',
            'is_approved' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ], [
            'featured_image.required' => 'لطفاً تصویر شاخص هتل را انتخاب کنید.',
            'name.required' => 'نام هتل الزامی است.',
            'province_id.required' => 'لطفاً ولایت را انتخاب کنید.',
            'address.required' => 'آدرس هتل الزامی است.',
            'phone.required' => 'شماره تماس هتل الزامی است.',
            'whatsapp.required' => 'شماره واتساپ هتل الزامی است.',
        ]);

        $featuredPath = $request->file('featured_image')->store('hotels', 'public');

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('hotels/gallery', 'public');
            }
        }

        Hotel::create([
            'user_id' => $request->user_id,
            'province_id' => $request->province_id,
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'website' => $request->website,
            'amenities' => json_encode($request->amenities ?? []),
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
            'languages_spoken' => $request->languages_spoken,
            'distance_from_city_center' => $request->distance_from_city_center,
            'is_approved' => $request->has('is_approved'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()->route('admin.hotels.index')
            ->with('success', '✅ هتل جدید با موفقیت اضافه شد.');
    }

    public function edit(Hotel $hotel)
    {
        $provinces = Province::where('is_active', true)->orderBy('name')->get();
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();
        $owners = User::where('role', 'hotel_owner')->where('is_approved', true)->get();

        return view('admin.hotels.edit', compact('hotel', 'provinces', 'destinations', 'owners'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($hotel->featured_image && \Storage::disk('public')->exists($hotel->featured_image)) {
                \Storage::disk('public')->delete($hotel->featured_image);
            }
            $featuredPath = $request->file('featured_image')->store('hotels', 'public');
        } else {
            $featuredPath = $hotel->featured_image;
        }

        $galleryPaths = $hotel->gallery_images ? json_decode($hotel->gallery_images, true) : [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('hotels/gallery', 'public');
            }
        }

        $hotel->update([
            'user_id' => $request->user_id,
            'province_id' => $request->province_id,
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'description_en' => $request->description_en,
            'featured_image' => $featuredPath,
            'gallery_images' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'website' => $request->website,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
            'languages_spoken' => $request->languages_spoken,
            'distance_from_city_center' => $request->distance_from_city_center,
            'is_approved' => $request->has('is_approved'),
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()->route('admin.hotels.index')
            ->with('success', '✅ هتل با موفقیت بروزرسانی شد.');
    }

    public function approve(Hotel $hotel)
    {
        $hotel->update(['is_approved' => !$hotel->is_approved]);
        $status = $hotel->is_approved ? 'تایید شد' : 'لغو تایید شد';
        return back()->with('success', "✅ هتل {$status}.");
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->featured_image && \Storage::disk('public')->exists($hotel->featured_image)) {
            \Storage::disk('public')->delete($hotel->featured_image);
        }
        if ($hotel->gallery_images) {
            foreach (json_decode($hotel->gallery_images) as $image) {
                if (\Storage::disk('public')->exists($image)) {
                    \Storage::disk('public')->delete($image);
                }
            }
        }
        $hotel->delete();
        return redirect()->route('admin.hotels.index')
            ->with('success', '✅ هتل با موفقیت حذف شد.');
    }
}
