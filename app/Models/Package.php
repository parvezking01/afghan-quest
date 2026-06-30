<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',          // ✅ added
        'slug',
        'description',
        'description_en',   // ✅ added
        'type',
        'duration_days',
        'duration_nights',
        'price',
        'discount_price',
        'max_travelers',
        'whatsapp',
        'includes_guide',
        'included_services',
        'excluded_services',
        'itinerary',
        'featured_image',
        'gallery_images',
        'is_trending',
        'is_active',
        'display_order'
    ];

    protected $casts = [
        'included_services' => 'array',
        'excluded_services' => 'array',
        'itinerary' => 'array',
        'gallery_images' => 'array',
        'includes_guide' => 'boolean',
        'is_trending' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($package) {
            if (!$package->slug) {
                $package->slug = Str::slug($package->name);
            }
        });
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'package_destinations')
            ->withPivot(['day_number', 'description'])
            ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function averageRating()
    {
        return $this->reviews()->where('is_approved', true)->avg('rating') ?? 0;
    }

    public function reviewsCount()
    {
        return $this->reviews()->where('is_approved', true)->count();
    }
}
