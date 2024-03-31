<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BetNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BetNumberController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return BetNumber::all();
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'bets_id' => 'required',
                'minimum' => 'required',
                'maximum' => 'required',
                'lottery_number' => 'nullable',
                'date_lottery_number_execution' => 'nullable'
            ]);
            
            $bet = new BetNumber();
            $bet->bets_id = $request->bets_id;
            $bet->minimum = $request->minimum;
            $bet->maximum = $request->maximum;
            $bet->lottery_number = $request->lottery_number;
            $bet->date_lottery_number_execution = $request->date_lottery_number_execution;

            if($request->filled('lottery_number')){
                $bet->lottery_number = $request->lottery_number;
            }

            if($request->filled('date_lottery_number_execution')){
                $bet->date_lottery_number_execution = $request->date_lottery_number_execution;
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $bet = BetNumber::findOrFail($id);
            return response()->json($bet);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        try{
            
            $request->validate([
                'bets_id' => 'required',
                'minimum' => 'required',
                'maximum' => 'required',
                'lottery_number' => 'nullable',
                'date_lottery_number_execution' => 'nullable'
            ]);

            $bet = BetNumber::findOrFail($id);
            $bet->bets_id = $request->bets_id;
            $bet->minimum = $request->minimum;
            $bet->maximum = $request->maximum;

            if($request->filled('lottery_number')){
                $bet->lottery_number = $request->lottery_number;
            }

            if($request->filled('date_lottery_number_execution')){
                $bet->date_lottery_number_execution = $request->date_lottery_number_execution;
            }

            $bet->save();
    
            return response(["message" => "Update successful"]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $bet = BetNumber::findOrFail($id);
            $bet->delete();
            return response(["message" => "Delete successful"], Response::HTTP_NO_CONTENT);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
