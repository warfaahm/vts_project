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
        Schema::create('disease_vaccine', function (Blueprint $table) {
            $table->unsignedBigInteger('vaccine_id');
            $table->unsignedBigInteger('diseases_id');

            $table->foreign('vaccine_id')->references('id')->on('vaccines');
            $table->foreign('diseases_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_vaccine');
    }
};