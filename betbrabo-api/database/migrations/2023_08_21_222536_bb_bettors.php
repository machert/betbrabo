<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bettor is an user who wants to bet, this table is design to determine the user and the bet and serve to base to
     * anothers tables
     */
    public function up(): void
    {
        Schema::create('bb_bettors', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('bets_id')->constrained('bb_bets');
            $table->foreignId('users_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bb_bettors');
    }
};
