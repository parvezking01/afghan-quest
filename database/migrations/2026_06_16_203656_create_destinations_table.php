<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->string('difficulty_level')->default('moderate'); // easy, moderate, challenging
            $table->text('highlights')->nullable();
            $table->text('required_permits')->nullable();
            $table->text('nearby_attractions')->nullable();
            $table->string('estimated_visit_duration')->nullable(); // e.g., "2-3 hours", "full day"
            $table->string('best_season')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
