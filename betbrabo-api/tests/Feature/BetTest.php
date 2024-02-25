<?php

namespace Tests\Feature;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Tymon\JWTAuth\Facades\JWTAuth;

class BetTest extends TestCase
{
    use RefreshDatabase;

    public function test_bets_should_be_able_to_create_bet()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('api/bets', [
            'name' => fake()->name(),
            'users_id' => $user->id,
            'date_start' => now(),
        ]);

        $response->assertCreated();
        $this->assertCount(1, Bet::all());
    }
    
    public function test_bets_should_be_able_to_create_bet_with_name_aposta_1()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $now_date = now();
        
        $response = $this->actingAs($user)->post('api/bets', [
            'name' => 'Aposta 1',
            'users_id' => $user->id,
            'date_start' => $now_date,
        ]);

        $response->assertCreated();
        $bet_first = Bet::where('name', 'Aposta 1');
        $this->assertNotNull($bet_first);
    }

    public function actingAs(UserContract $user, $guard = null)
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization',"Bearer {$token}");
        parent::actingAs($user);
        return $this;
    }


}
