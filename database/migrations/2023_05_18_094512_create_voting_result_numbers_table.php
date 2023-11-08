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
        Schema::create('voting_result_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('voting_result_id')->nullable();
            $table->foreign('voting_result_id')->references('id')->on('voting_results');
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
        Schema::dropIfExists('voting_result_numbers');
    }
};
