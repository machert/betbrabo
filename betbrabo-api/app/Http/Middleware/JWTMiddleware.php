<?php

namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Tymon\JWTAuth\Facades\JWTAuth;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if(!$request->bearerToken()){
    //         return response()->json(['status'=>false,'message'=>'Authorization token not found'],401);
    //     }

    //     JWTAuth::setRequest($request);
    //     try {
    //         $user = JWTAuth::toUser(JWTAuth::getToken());
    //     }catch (\Exception $e){
    //         return response()->json(['status'=>false,'message'=>'Token is invalid'],401);
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        if(!$request->bearerToken()){
            return response()->json(['status' => false, 'message'=> 'Authorization token not found'], 401);
        }

        JWTAuth::setRequest($request);
        try {
            $user = JWTAuth::toUser(JWTAuth::getToken());
        }catch (\Exception $e){
            return response()->json(['status' => false, 'message' => 'Token is invalid'], 401);
        }

        return $next($request);
    }
}
