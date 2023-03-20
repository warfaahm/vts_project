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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('next_due_date');
            $table->integer('dose_no');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('dependent_id')->nullable();
            $table->unsignedBigInteger('vaccine_id');
            $table->unsignedBigInteger('hospital_id');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('dependent_id')->references('id')->on('dependents');
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
