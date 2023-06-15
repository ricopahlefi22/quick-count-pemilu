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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('evidence_image')->nullable();
            $table->string('name');
            $table->string('id_number');
            $table->string('family_card_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('birthplace')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender', 5)->nullable();
            $table->string('marital_status', 5)->nullable();
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->tinyInteger('disability_information')->default(0)->nullable();
            $table->string('e_ktp_record_state', 5)->nullable();
            $table->string('e_ktp_image')->nullable();
            $table->text('note')->nullable();
            $table->boolean('level')->default(0);
            $table->foreignId('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreignId('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            $table->foreignId('voting_place_id')->nullable();
            $table->foreign('voting_place_id')->references('id')->on('voting_places');
            $table->foreignId('coordinator_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('voters', function (Blueprint $table) {
            $table->foreign('coordinator_id')->references('id')->on('voters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
