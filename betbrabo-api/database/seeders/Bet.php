<?php

namespace Database\Seeders;

use App\Models\Bet as ModelsBet;
use Illuminate\Database\Seeder;

class Bet extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsBet::create([
            'name' => 'dice',
            'users_id' => 2,
            'date_start' => '2023-08-23'
        ]);
        
    }
}
