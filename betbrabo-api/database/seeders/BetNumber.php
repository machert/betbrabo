<?php

namespace Database\Seeders;

use App\Models\BetNumber as ModelsBetNumber;
use Illuminate\Database\Seeder;

class BetNumber extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ModelsBetNumber::create(['bets_id' => 1, 'minimum' => 1, 'maximum' => 6]);
        ModelsBetNumber::create(['bets_id' => 1, 'minimum' => 1, 'maximum' => 6]);
        ModelsBetNumber::create(['bets_id' => 1, 'minimum' => 1, 'maximum' => 6]);
        ModelsBetNumber::create(['bets_id' => 1, 'minimum' => 1, 'maximum' => 6]);
        ModelsBetNumber::create(['bets_id' => 1, 'minimum' => 1, 'maximum' => 6]);
        ModelsBetNumber::create(['bets_id' => 1, 'minimum' => 1, 'maximum' => 6]);
    }
}
