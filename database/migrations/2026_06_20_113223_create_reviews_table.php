<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reviewable_type');
            $table->unsignedBigInteger('reviewable_id');
            $table->integer('rating');
            $table->text('comment');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['reviewable_type', 'reviewable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
