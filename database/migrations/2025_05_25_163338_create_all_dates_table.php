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
        Schema::create('all_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ovijog_id');
            $table->foreign('ovijog_id')->references('id')->on('ovijogs')->onDelete('cascade');

            // Date fields
            $table->date('creation_date')->nullable();
            $table->date('processing_date')->nullable();
            $table->json('date_list')->nullable(); 
            $table->date('complete_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_dates');
    }
};
