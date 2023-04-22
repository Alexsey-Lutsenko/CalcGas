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
        Schema::create('constant_references', function (Blueprint $table) {
            $table->id();
            $table->float('temperatureMin', 2, 2);
            $table->float('temperatureMax',2, 2);
            $table->float('rate', 1, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constant_references');
    }
};
