<?php

namespace Tests\Feature;

use App\Http\Middleware\JWTMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function test_the_user_route_return_a_successful_response(): void
    // {
    //     $response = $this->get('/api/users');
    //     // $response->assertOk();
    //     $this->assertCount(0, User::all());
    //     // $response->assertStatus(200);
    // }

    // public function teste_autenthication_with_

    // public function test_jwt_(){
    //     $request = new Request();
    //     $jwt = new JWTMiddleware();
    //     $response = $jwt->handle($request, function(){});
    //     $this->assertNotNull($jwt);
    //     $this->assertNotNull($resp);
    // }

}
