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
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreignId('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            $table->foreignId('voting_place_id')->nullable();
            $table->foreign('voting_place_id')->references('id')->on('voting_places');
            $table->foreignId('voter_id')->nullable();
            $table->foreign('voter_id')->references('id')->on('voters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitors');
    }
};
