<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    // use HasFactory, Notifiable;  // ← HasFactory MUST be here

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'whatsapp',
        'role',
        'is_approved',
        'is_active',
        'avatar',
        'address',
        'passport_number'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_approved' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isHotelOwner()
    {
        return $this->role === 'hotel_owner';
    }

    public function isTourist()
    {
        return $this->role === 'tourist';
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
