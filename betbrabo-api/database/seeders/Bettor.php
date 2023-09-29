<?php

namespace Database\Seeders;

use App\Models\Bettor as ModelsBettor;
use Illuminate\Database\Seeder;

class Bettor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsBettor::create(['bets_id' => 1, 'users_id' => 3]);
        ModelsBettor::create(['bets_id' => 1, 'users_id' => 4]);
        ModelsBettor::create(['bets_id' => 1, 'users_id' => 5]);

    }
}
