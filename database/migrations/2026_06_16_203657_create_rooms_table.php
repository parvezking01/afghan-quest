<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('room_type'); // Single, Double, Suite, etc.
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);
            $table->integer('capacity'); // Max guests
            $table->integer('total_rooms');
            $table->integer('available_rooms');
            $table->json('amenities')->nullable(); // TV, AC, etc.
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
