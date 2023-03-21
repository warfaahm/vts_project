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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('vaccine_name');
            $table->string('manufacturer');
            $table->string('contains');
            $table->integer('dosage');
            $table->string('age_range');
            // $table->unsignedBigInteger('disease_id');
            $table->integer('dose_1_duration')->nullable();
            $table->integer('dose_2_duration')->nullable();
            $table->integer('dose_3_duration')->nullable();
            $table->integer('validity_duration')->nullable();
            $table->decimal('price', 8,2);
            $table->timestamps();

            // $table->foreign('disease_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
