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
        Schema::create('voting_results', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->foreignId('voting_place_id')->nullable();
            $table->foreign('voting_place_id')->references('id')->on('voting_places');
            $table->foreignId('party_id')->nullable();
            $table->foreign('party_id')->references('id')->on('parties');
            $table->foreignId('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_results');
    }
};
