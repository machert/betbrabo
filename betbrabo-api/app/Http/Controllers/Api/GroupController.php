<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupController extends Controller
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
            return Group::all();
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
        // try{
            $request->validate([
                'name' => 'required|unique:bb_groups|max:255|min:4',
            ]);

            $group = new Group();            
            $group->name = $request->name;
            $saved = $group->save();
            if($saved){
                return response(["message" => "Save successful"], ["status" => Response::HTTP_CREATED]);
            }else{
                throw new BadRequestException("Error on save new group");
            }
        // }
        // catch(\Exception $e){
        //     throw $e;
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $group = Group::findOrFail($id);
            return response()->json($group);
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
                'name' => 'required|max:255|min:4|unique:bb_groups,name,'.$id,
            ]);
            $group = Group::findOrFail($id);
            $group->name = $request->name;
    
            $group->save();

            return response(["message" => "Update successful"], ["status" => Response::HTTP_OK]);
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
            $group = Group::findOrFail($id);
            $group->delete();
            return response(["message" => "Delete successful"], ["status" => Response::HTTP_NO_CONTENT]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
