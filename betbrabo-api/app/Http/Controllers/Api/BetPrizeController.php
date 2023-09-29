<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BetPrize;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BetPrizeController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        try{
            return BetPrize::all();
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'bets_id' => 'required',
                'prize' => 'required|min:1',
                'hits' => 'required|min:1',
            ]);
            
            $betPrize = new BetPrize();
            $betPrize->bets_id = $request->bets_id;
            $betPrize->prize = $request->prize;
            $betPrize->hits = $request->hits;

            $saved = $betPrize->save();
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
            $betPrize = BetPrize::findOrFail($id);
            return response()->json($betPrize);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function update(Request $request, string $id)
    {
        
        try{

            $request->validate([
                'bets_id' => 'required',
                'prize' => 'required|min:1',
                'hits' => 'required|min:1',
            ]);

            $betPrize = BetPrize::findOrFail($id);
            $betPrize->bets_id = $request->bets_id;
            $betPrize->prize = $request->prize;
            $betPrize->hits = $request->hits;

            $betPrize->save();
    
            return response(["message" => "Update successful"], Response::HTTP_OK);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function destroy(string $id)
    {
        try{
            $betPrize = BetPrize::findOrFail($id);
            $betPrize->delete();
            return response(Response::HTTP_NO_CONTENT);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
