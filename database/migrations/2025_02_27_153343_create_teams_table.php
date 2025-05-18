<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('institution');
            $table->string('team_name');

            // Member 1 (Required)
            $table->string('member1_name');
            $table->string('member1_id')->unique();
            $table->string('member1_email')->unique();
            $table->string('member1_phone');
            $table->string('member1_tshirt_size');

            // Member 2 (Optional)
            $table->string('member2_name')->nullable();
            $table->string('member2_id')->nullable()->unique();
            $table->string('member2_email')->nullable()->unique();
            $table->string('member2_phone')->nullable();
            $table->string('member2_tshirt_size')->nullable();

            // Member 3 (Optional)
            $table->string('member3_name')->nullable();
            $table->string('member3_id')->nullable()->unique();
            $table->string('member3_email')->nullable()->unique();
            $table->string('member3_phone')->nullable();
            $table->string('member3_tshirt_size')->nullable();

            // Coach Info
            $table->string('coach_name');
            $table->string('coach_email')->unique();
            $table->string('coach_phone');
            $table->string('coach_tshirt_size');

            // Default columns
            $table->boolean('approve')->default(0);
            $table->boolean('payment')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
};


