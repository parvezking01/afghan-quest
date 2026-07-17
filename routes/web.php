<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\TrendingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\ProvinceController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\HotelOwner\DashboardController as HotelOwnerDashboard;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tourist\DashboardController as TouristDashboard;
use Illuminate\Support\Facades\Route;

// Language Switcher
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Provinces
Route::get('/provinces', [ProvinceController::class, 'index'])->name('provinces.index');
Route::get('/provinces/{slug}', [ProvinceController::class, 'show'])->name('provinces.show');

// Destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Hotels
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{slug}', [HotelController::class, 'show'])->name('hotels.show');

// Packages
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Auth Routes
require __DIR__.'/auth.php';

// Authenticated Routes (Login Required)
Route::middleware(['auth'])->group(function () {

    // Profile Routes (All authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Review Route
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Booking Routes (Require Login)
    Route::get('/book/package/{slug}', [BookingController::class, 'createPackageBooking'])->name('booking.package.create');
    Route::post('/book/package', [BookingController::class, 'storePackageBooking'])->name('booking.package.store');
    Route::get('/book/hotel/{slug}', [BookingController::class, 'createHotelBooking'])->name('booking.hotel.create');
    Route::post('/book/hotel', [BookingController::class, 'storeHotelBooking'])->name('booking.hotel.store');

    // Tourist Routes
    Route::middleware(['role:tourist'])->prefix('tourist')->name('tourist.')->group(function () {
        Route::get('/dashboard', [TouristDashboard::class, 'index'])->name('dashboard');
        Route::get('/bookings', [TouristDashboard::class, 'bookings'])->name('bookings');
        Route::get('/profile', [TouristDashboard::class, 'profile'])->name('profile');
        Route::put('/profile', [TouristDashboard::class, 'updateProfile'])->name('profile.update');
    });

    // Hotel Owner Routes
    Route::middleware(['role:hotel_owner'])->prefix('hotel-owner')->name('hotel_owner.')->group(function () {
        Route::get('/dashboard', [HotelOwnerDashboard::class, 'index'])->name('dashboard');
        Route::get('/hotels', [HotelOwnerDashboard::class, 'hotels'])->name('hotels.index');
        Route::get('/hotels/create', [HotelOwnerDashboard::class, 'createHotel'])->name('hotels.create');
        Route::post('/hotels', [HotelOwnerDashboard::class, 'storeHotel'])->name('hotels.store');
        Route::get('/hotels/{hotel}/edit', [HotelOwnerDashboard::class, 'editHotel'])->name('hotels.edit');
        Route::put('/hotels/{hotel}', [HotelOwnerDashboard::class, 'updateHotel'])->name('hotels.update');
        Route::get('/hotels/{hotel}/rooms', [HotelOwnerDashboard::class, 'rooms'])->name('rooms.index');
        Route::post('/hotels/{hotel}/rooms', [HotelOwnerDashboard::class, 'storeRoom'])->name('rooms.store');
        Route::put('/hotels/{hotel}/rooms/{room}', [HotelOwnerDashboard::class, 'updateRoom'])->name('rooms.update');
        Route::delete('/hotels/{hotel}/rooms/{room}', [HotelOwnerDashboard::class, 'destroyRoom'])->name('rooms.destroy');
        Route::get('/bookings', [HotelOwnerDashboard::class, 'bookings'])->name('bookings');
        Route::patch('/bookings/{booking}/status', [HotelOwnerDashboard::class, 'updateBookingStatus'])->name('bookings.status');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::resource('provinces', App\Http\Controllers\Admin\ProvinceController::class);
        Route::resource('destinations', App\Http\Controllers\Admin\DestinationController::class);
        Route::resource('hotels', App\Http\Controllers\Admin\HotelController::class);
        Route::patch('/hotels/{hotel}/approve', [App\Http\Controllers\Admin\HotelController::class, 'approve'])->name('hotels.approve');
        Route::resource('packages', App\Http\Controllers\Admin\PackageController::class);
        Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
        Route::patch('/bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.status');
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
        Route::get('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
        Route::patch('/reviews/{review}/approve', [App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('reviews.approve');
        Route::delete('/reviews/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::get('/trending', [TrendingController::class, 'index'])->name('trending.index');
        Route::post('/trending/toggle', [TrendingController::class, 'toggle'])->name('trending.toggle');
    });
});
