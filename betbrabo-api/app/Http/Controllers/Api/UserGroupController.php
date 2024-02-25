<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserGroupController extends Controller
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
            return UserGroup::all();
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
                'users_id' => 'required',
                'groups_id' => 'required',
            ]);
            $userGroup = new UserGroup();
            $userGroup->users_id = $request->users_id;
            $userGroup->groups_id = $request->groups_id;
            $saved = $userGroup->save();
            if($saved){
                return response(["message" => "Save successful"], ["status" => Response::HTTP_CREATED]);
            }else{
                throw new BadRequestException("Error on save new user group");
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
            $userGroup = UserGroup::findOrFail($id);
            return response()->json($userGroup);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    
    /**
     * Display the specified resource.
     */
    public function findByUserId(string $id)
    {
        try{
            $user = User::findOrFail($id);
            $userGroup = $user->groups;

            return response()->json($userGroup);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }

    
    /**
     * Display the specified resource.
     */
    public function findByGroupId(string $id)
    {
        try{
            $group = Group::findOrFail($id);
            $userGroup = $group->users;

            return response()->json($userGroup);
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
                'users_id' => 'required',
                'groups_id' => 'required',
            ]);
            $userGroup = UserGroup::findOrFail($id);
            $userGroup->users_id = $request->users_id;
            $userGroup->groups_id = $request->groups_id;

            $userGroup->save();

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
            $userGroup = UserGroup::findOrFail($id);
            $userGroup->delete();
            return response(["message" => "Delete successful"], ["status" => Response::HTTP_NO_CONTENT]);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
