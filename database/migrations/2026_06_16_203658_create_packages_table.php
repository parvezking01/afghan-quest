<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('type'); // provincial, regional, thematic, custom
            $table->integer('duration_days');
            $table->integer('duration_nights');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('max_travelers')->default(10);
            $table->boolean('includes_guide')->default(true);
            $table->json('included_services')->nullable(); // Transport, meals, etc.
            $table->json('excluded_services')->nullable();
            $table->json('itinerary')->nullable(); // Day by day plan
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
