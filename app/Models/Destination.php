<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
        'name_en',
        'slug',
        'description',
        'description_en',  // ✅ added
        'featured_image',
        'gallery_images',
        'difficulty_level',
        'highlights',
        'required_permits',
        'nearby_attractions',
        'estimated_visit_duration',
        'best_season',
        'latitude',
        'longitude',
        'is_trending',
        'is_active',
        'display_order'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_trending' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($destination) {
            if (!$destination->slug) {
                $destination->slug = Str::slug($destination->name);
            }
        });
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_destinations')
            ->withPivot(['day_number', 'description'])
            ->withTimestamps();
    }

    public function wishlistedBy()
    {
        return $this->morphMany(Wishlist::class, 'wishlistable');
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
