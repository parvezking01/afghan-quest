<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'province_id',
        'destination_id',
        'name',
        'name_en',          // ✅ added
        'slug',
        'description',
        'description_en',   // ✅ added
        'featured_image',
        'gallery_images',
        'address',
        'phone',
        'whatsapp',
        'email',
        'website',
        'amenities',
        'check_in_time',
        'check_out_time',
        'languages_spoken',
        'distance_from_city_center',
        'is_approved',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'amenities' => 'array',
        'is_approved' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hotel) {
            if (! $hotel->slug) {
                $hotel->slug = Str::slug($hotel->name);
            }
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function availableRooms()
    {
        return $this->rooms()->where('available_rooms', '>', 0)->where('is_active', true);
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
