<?php

namespace Database\Seeders;

use App\Models\BettorNumber as ModelsBettorNumber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BettorNumber extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsBettorNumber::create(['bettors_id' => 1, 'number' => 3]);
        ModelsBettorNumber::create(['bettors_id' => 1, 'number' => 4]);
        ModelsBettorNumber::create(['bettors_id' => 1, 'number' => 5]);
        ModelsBettorNumber::create(['bettors_id' => 1, 'number' => 1]);
        ModelsBettorNumber::create(['bettors_id' => 1, 'number' => 1]);
        ModelsBettorNumber::create(['bettors_id' => 1, 'number' => 3]);
        
        ModelsBettorNumber::create(['bettors_id' => 2, 'number' => 2]);
        ModelsBettorNumber::create(['bettors_id' => 2, 'number' => 6]);
        ModelsBettorNumber::create(['bettors_id' => 2, 'number' => 1]);
        ModelsBettorNumber::create(['bettors_id' => 2, 'number' => 2]);
        ModelsBettorNumber::create(['bettors_id' => 2, 'number' => 3]);
        ModelsBettorNumber::create(['bettors_id' => 2, 'number' => 5]);
        
        ModelsBettorNumber::create(['bettors_id' => 3, 'number' => 1]);
        ModelsBettorNumber::create(['bettors_id' => 3, 'number' => 2]);
        ModelsBettorNumber::create(['bettors_id' => 3, 'number' => 5]);
        ModelsBettorNumber::create(['bettors_id' => 3, 'number' => 1]);
        ModelsBettorNumber::create(['bettors_id' => 3, 'number' => 3]);
        ModelsBettorNumber::create(['bettors_id' => 3, 'number' => 4]);
    }
}
