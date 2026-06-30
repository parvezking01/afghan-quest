<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Dari name
            $table->string('name_en')->nullable(); // English name
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->text('history')->nullable();
            $table->text('culture')->nullable();
            $table->text('best_time_to_visit')->nullable();
            $table->text('local_food')->nullable();
            $table->text('transportation_info')->nullable();
            $table->string('safety_level')->default('moderate'); // safe, moderate, caution
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provinces');
    }
};
