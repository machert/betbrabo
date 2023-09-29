<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The Bet is create by an user manager or high level, 
     */
    public function up(): void
    {
        Schema::create('bb_bets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('users_id')->constrained('users');
            $table->datetime('date_start')->nullable();
            $table->datetime('data_end')->nullable();
            $table->datetime('data_execution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bb_bets');
    }
};
