<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('phone');
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('discount_price');
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('whatsapp');
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('whatsapp');
        });
    }
};
