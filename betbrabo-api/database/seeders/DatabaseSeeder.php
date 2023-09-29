<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(User::class);
        $this->call(Group::class);
        $this->call(UserGroup::class);
        $this->call(Bet::class);
        $this->call(BetNumber::class);
        $this->call(BetPrize::class);
        $this->call(Bettor::class);
        $this->call(BettorNumber::class);
    }
}
