<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Hotel owner
            $table->foreignId('province_id')->constrained()->onDelete('cascade');
            $table->foreignId('destination_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->text('address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->json('amenities')->nullable(); // WiFi, parking, restaurant, etc.
            $table->string('check_in_time')->default('14:00');
            $table->string('check_out_time')->default('12:00');
            $table->text('languages_spoken')->nullable();
            $table->decimal('distance_from_city_center', 8, 2)->nullable(); // in km
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
};
