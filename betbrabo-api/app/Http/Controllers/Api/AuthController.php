<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','sessionExpired']]);//exceções
    }
    
    /**
     * @OA\Get(
     *    path="/api/sessionExpired",
     *    tags={"Auth"},
     *    @OA\Response(response=200, description="OK"),
     * 
     * )
     */
    public function sessionExpired()
    {
        return response()->json(['error' => 'session expired'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @OA\Post(
     *    path="/api/login",
     *    tags={"Auth"},
     *    @OA\Response(response=200, description="OK"),
     * 
     * )
     */
    public function login(Request $request)
    {
        try{

            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            $credentials = $request->only('email', 'password');
            $token = Auth::attempt($credentials);
            if (!$token ) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], Response::HTTP_UNAUTHORIZED);
            }
            
            return $this->respondWithToken($token);
        }catch(\Exception $e){
            return response()->json([
                'message' =>  $e,
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            ],
            Response::HTTP_CREATED
        );
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // return ['status'=>'ok'];
        return response()->json(auth()->user());
    }

    
    /**
     * Log the user out
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *    path="/api/logout",
     *    tags={"Auth"},
     *    @OA\Response(response=200, description="OK"),
     * 
     * )
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *    path="/api/refresh",
     *    tags={"Auth"},
     *    @OA\Response(response=200, description="OK"),
     * 
     * )
     */
    public function refresh()
    {
        $token = Auth::refresh();

        $this->respondWithToken($token);

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                // 'expires_in' => auth()->factory()->getTTL() * 60
                'expires_in' => Auth::factory()->getTTL() * 60
            ]
        ]);
    }
}
