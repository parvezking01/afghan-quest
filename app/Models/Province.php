<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'description',
        'description_en',
        'featured_image',
        'gallery_images',
        'history',
        'culture',
        'best_time_to_visit',
        'local_food',
        'transportation_info',
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

        static::creating(function ($province) {
            if (!$province->slug) {
                $province->slug = Str::slug($province->name);
            }
        });
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
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
