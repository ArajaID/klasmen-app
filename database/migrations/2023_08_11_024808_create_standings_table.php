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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->string('club');
            $table->bigInteger('Ma');
            $table->bigInteger('Me');
            $table->bigInteger('S');
            $table->bigInteger('K');
            $table->bigInteger('GM');
            $table->bigInteger('GK');
            $table->bigInteger('Point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
