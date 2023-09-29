<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * An user have one or more groups, this table serve to specify theses groups
     */
    public function up(): void
    {
        Schema::create('bb_users_groups', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('groups_id')->constrained('bb_groups');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bb_users_groups');
    }
};
