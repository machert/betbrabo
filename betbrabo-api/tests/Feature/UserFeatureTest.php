<?php

namespace Tests\Feature;

use App\Http\Middleware\JWTMiddleware;
// use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
      */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_user_should_be_able_to_view_users()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('api/users');
        $response->assertOk();
        $this->assertCount(1, User::all());
    }
    
    public function test_user_should_be_able_to_create_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('api/users', [
            'name' => fake()->name(),
            'cpf' => fake()->unique()->numerify('###########'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('1234'),
        ]);

        $response->assertCreated();
        $this->assertCount(2, User::all());
    }

    public function actingAs(UserContract $user, $guard = null)
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization',"Bearer {$token}");
        parent::actingAs($user);
        return $this;
    }

}
