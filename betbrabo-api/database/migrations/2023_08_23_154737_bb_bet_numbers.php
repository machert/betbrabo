<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The numbers of the bet, each row in the table will have an minimum and maximum.
     * lottery number is the the number drawn
     */
    public function up(): void
    {
        Schema::create('bb_bet_numbers', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('bets_id')->constrained('bb_bets');
            $table->integer('minimum');
            $table->integer('maximum');
            $table->integer('lottery_number')->nullable();
            $table->date('date_lottery_number_execution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bb_bet_numbers');
    }
};
