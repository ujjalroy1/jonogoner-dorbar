<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ovijogs', function (Blueprint $table) {
            $table->text('attachment')->change();
        });
    }

    public function down()
    {
        Schema::table('ovijogs', function (Blueprint $table) {
            $table->string('attachment')->change();
        });
    }
};
