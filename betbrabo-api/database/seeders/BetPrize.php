<?php

namespace Database\Seeders;

use App\Models\BetPrize as ModelsBetPrize;
use Illuminate\Database\Seeder;

class BetPrize extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsBetPrize::create(['bets_id' => 1, 'prize' => 1000, 'hits' => 5]);
        ModelsBetPrize::create(['bets_id' => 1, 'prize' => 10000, 'hits' => 6]);
    }
}
