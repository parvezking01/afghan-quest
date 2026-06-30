<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Provinces
        Schema::table('provinces', function (Blueprint $table) {
            if (!Schema::hasColumn('provinces', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            if (!Schema::hasColumn('provinces', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });

        // Destinations
        Schema::table('destinations', function (Blueprint $table) {
            if (!Schema::hasColumn('destinations', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            if (!Schema::hasColumn('destinations', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });

        // Hotels
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            if (!Schema::hasColumn('hotels', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });

        // Packages
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            if (!Schema::hasColumn('packages', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });

        // Rooms
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'room_type_en')) {
                $table->string('room_type_en')->nullable()->after('room_type');
            }
            if (!Schema::hasColumn('rooms', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });
    }

    public function down()
    {
        // Optional: drop columns if rollback needed
    }
};
