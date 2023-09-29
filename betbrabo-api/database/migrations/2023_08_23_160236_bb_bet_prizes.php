<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The prizes for a minimum hits of the bet, if an user hit numbers equal to or greater than
     * the hits he wins the prize
     */
    public function up(): void
    {
        Schema::create('bb_bet_prizes', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('bets_id')->constrained('bb_bets');
            $table->double('prize');
            $table->integer('hits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bb_bet_prizes');
    }
};
