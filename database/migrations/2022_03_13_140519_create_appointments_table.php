<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('date');
            $table->time('time');
            $table->integer('duration')->default(40);
            $table->text('details');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->constrained()->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
