<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pick_chairs', function (Blueprint $table) {
            $table->id();
            $table->string('day_pick')->nullable();
            $table->string('movie_pick')->nullable();
            $table->string('hall_pick')->nullable();
            $table->string('startTime_pick')->nullable();
            $table->json('selected_chair')->nullable();
            $table->integer('price_pick')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pick_chairs');
    }
};
