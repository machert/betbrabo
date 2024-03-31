<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Tymon\JWTAuth\Facades\JWTAuth;

class BetController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/bets/index",
     *     tags={"Bets"},
     *     summary="Display a listing of bets",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="users_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="date_start",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="data_end",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="data_execution",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     type="string"
     *                 ),
     *                 example={
     *                     "id": 1,
     *                     "name": "dice",
     *                     "users_id": 2,
     *                     "date_start": "2023-08-23 00:00:00",
     *                     "data_end": null,
     *                     "data_execution": null,
     *                     "created_at": "2023-08-28T19:03:17.000000Z",
     *                     "updated_at": "2023-08-28T19:03:17.000000Z"
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * Display a listing of bets.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{
            return Bet::all();
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
    
    public function listByUsersId(Request $request)
    {
        try{
            $users_id = Auth::user()->id;
            return Bet::where('users_id', $users_id)->get();
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    /**
     * @OA\Post(
     *     path="/bets/store",
     *     tags={"Bets"},
     *     summary="Store a newly created bet in storage",
     *     @OA\RequestBody(
     *         description="JSON containing bet data",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "users_id", "date_start"},
     *                 properties={
     *                     @OA\Property(property="name", type="string", example="Bet Name"),
     *                     @OA\Property(property="users_id", type="integer", example=1),
     *                     @OA\Property(property="date_start", type="string", format="date", example="2023-09-27"),
     *                     @OA\Property(property="date_end", type="string", format="date", example="2023-09-30"),
     *                     @OA\Property(property="date_execution", type="string", format="date", example="2023-10-05"),
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Created",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     *
     * Store a newly created bet in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|max:255|min:4',
                'users_id' => 'required',
                'date_start' => 'required|date',
                'date_end' => 'date|nullable',
                'date_execution' => 'date|nullable'
            ]);

            $bet = new Bet();
            $bet->name = $request->name;
            $bet->users_id = $request->users_id;
            $bet->date_start = $request->date_start;

            if($request->filled('date_end')){
                $bet->date_end = $request->date_end;
            }

            if($request->filled('date_execution')){
                $bet->date_execution = $request->date_execution;
            }

            $saved = $bet->save();
            if($saved){
                return response(["message" => "Save successful"], Response::HTTP_CREATED);
            }else{
                throw new BadRequestException("Error on save new bet");
            }
        }
        catch(\Exception $e){
            throw $e;
        }
    }
    
    /**
     * @OA\Get(
     *     path="/bets/show",
     *     tags={"Bets"},
     *     summary="Display the specified bet",     
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     *
     * Display the specified bet.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        try{
            $bet = Bet::findOrFail($id);
            return response()->json($bet);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    /**
     * @OA\Get(
     *     path="/bets/update",
     *     tags={"Bets"},
     *     summary="Update the specified bet in storage",     
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     *
     * Update the specified bet in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        
        try{
            
            $request->validate([
                'name' => 'required|max:255|min:4',
                'users_id' => 'required',
                'date_start' => 'required|date',
                'date_end' => 'date|nullable',
                'date_execution' => 'date|nullable'
            ]);

            $bet = Bet::findOrFail($id);
            $bet->name = $request->name;
            $bet->users_id = $request->users_id;
            $bet->date_start = $request->date_start;
            
            if($request->filled('date_end')){
                $bet->date_end = $request->date_end;
            }

            if($request->filled('date_execution')){
                $bet->date_execution = $request->date_execution;
            }

            $bet->save();
    
            return response(["message" => "Update successful"]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    /**
     * @OA\Get(
     *     path="/bets/destroy",
     *     tags={"Bets"},
     *     summary="Remove the specified bet from storage",     
     *     @OA\Response(
     *         response="200",
     *         description="NO_CONTENT",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     *
     * Remove the specified bet from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        try{
            $bet = Bet::findOrFail($id);
            $bet->delete();
            return response(["message" => "Delete successful"], Response::HTTP_NO_CONTENT);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
