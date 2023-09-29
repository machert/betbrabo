<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Numbers bet by bettor
     */
    public function up(): void
    {
        Schema::create('bb_bettors_numbers', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('bettors_id')->constrained('bb_bettors');
            $table->integer('number');
            $table->boolean('hit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bb_bettors_numbers');
    }
};
