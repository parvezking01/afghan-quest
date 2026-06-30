<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('total_amount');
            }
            if (!Schema::hasColumn('bookings', 'guest_name')) {
                $table->string('guest_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('bookings', 'guest_message')) {
                $table->text('guest_message')->nullable()->after('special_requests');
            }
            if (!Schema::hasColumn('bookings', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('guest_message');
            }
        });
    }

    public function down()
    {
        //
    }
};
