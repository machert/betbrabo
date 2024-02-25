<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bettor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BettorController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        try{
            return Bettor::all();
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function create(Request $request)
    {
        try{
            $request->validate([
                'bets_id' => 'required',
                'users_id' => 'required',
            ]);

            $bettor = new Bettor();            
            
            $bettor->bets_id = $request->bets_id;
            $bettor->users_id = $request->users_id;

            $saved = $bettor->save();
            if($saved){
                return response(["message" => "Save successful"], ["status" => Response::HTTP_CREATED]);
            }else{
                throw new BadRequestException("Error on save new bettor");
            }
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function show(string $id)
    {
        try{
            $bettor = Bettor::findOrFail($id);
            return response()->json($bettor);
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
                'users_id' => 'required',
            ]);


            $bettor = Bettor::findOrFail($id);
            $bettor->bets_id = $request->bets_id;
            $bettor->users_id = $request->users_id;

            $bettor->save();
    
            return response(["message" => "Update successful"], ["status" => Response::HTTP_OK]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    public function destroy(string $id)
    {
        try{
            $bettor = Bettor::findOrFail($id);
            $bettor->delete();
            return response(["message" => "Delete successful"], ["status" => Response::HTTP_NO_CONTENT]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
