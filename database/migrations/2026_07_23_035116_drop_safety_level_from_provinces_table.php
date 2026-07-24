<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropColumn('safety_level');
        });
    }

    public function down()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->string('safety_level')->default('moderate');
        });
    }
};
