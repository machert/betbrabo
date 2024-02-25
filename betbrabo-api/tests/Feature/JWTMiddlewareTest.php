<?php

namespace Tests\Feature;

use App\Http\Middleware\JWTMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddlewareTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_jwt_send_error_if_no_token(){
        $request = new Request();
        $jwt = new JWTMiddleware();
        $response = $jwt->handle($request, function(){});
        $this->assertNotNull($jwt);
        $this->assertEquals($response->getStatusCode(), 401);
    }

    public function test_jwt_send_error_if_wrong_token(){
        $request = new Request();
        $jwt = new JWTMiddleware();
        $request->headers->set('Authorization', "Bearer Marsupilamivemcorrendopelaselva");
        $response = $jwt->handle($request, function(){});
        $this->assertNotNull($jwt);
        $this->assertEquals($response->getStatusCode(), 401);
    }

    public function test_jwt_allow_authorize_if_correct_token(){
        $request = new Request();
        $jwt = new JWTMiddleware();
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $request->headers->set('Authorization', "Bearer {$token}");
        $response = $jwt->handle($request, function(){});
        $this->assertNotNull($jwt);
        $this->assertNull($response);
    }

}
