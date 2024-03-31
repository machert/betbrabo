<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BettorNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BettorNumberController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        try{
            return BettorNumber::all();
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'bettors_id' => 'required',
                'number' => 'required|integer',
                'hit' => 'integer',
            ]);
            
            $bet = new BettorNumber();
            $bet->bettors_id = $request->bettors_id;
            $bet->number = $request->number;

            if($request->filled('hit')){
                $bet->hit = $request->hit;
            }else{
                $bet->hit = 0;
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

    public function show(string $id)
    {
        try{
            $bet = BettorNumber::findOrFail($id);
            return response()->json($bet);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function update(Request $request, string $id)
    {
        
        try{
            
            $request->validate([
                'bettors_id' => 'required',
                'number' => 'required|integer',
                'hit' => 'integer',
            ]);

            $bet = BettorNumber::findOrFail($id);
            $bet->bettors_id = $request->bettors_id;
            $bet->number = $request->number;

            if($request->filled('hit')){
                $bet->hit = $request->hit;
            }else{
                $bet->hit = 0;
            }

            $bet->save();
    
            return response(["message" => "Update successful"]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function destroy(string $id)
    {
        try{
            $bet = BettorNumber::findOrFail($id);
            $bet->delete();
            return response(["message" => "Delete successful"], Response::HTTP_NO_CONTENT);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
