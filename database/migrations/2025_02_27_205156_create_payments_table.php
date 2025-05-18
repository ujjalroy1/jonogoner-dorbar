<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->string('payment_from');
            $table->string('payment_to');
            $table->string('transaction_id');
            $table->boolean('approved')->default(0); // Default is 0 (pending)
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('payments');
    }
};

