<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('hotel_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('set null');
            $table->string('booking_number')->unique();
            $table->string('booking_type'); // package, hotel, both
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->date('travel_date')->nullable();
            $table->integer('number_of_travelers')->default(1);
            $table->integer('number_of_rooms')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->string('whatsapp_number');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending', 'contacted', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
