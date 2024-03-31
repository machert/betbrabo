<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserController extends Controller
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
        return User::all();
        $users = User::all();
        return $users->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|unique:users,name|max:255|min:4',
                'email' => 'required|email|unique:users,email',
                'cpf' => 'required|unique:users,cpf|digits:11',
                'password' => 'required|min:6',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
            $user->password = bcrypt($request->password);
            $saved = $user->save();
            if($saved){
                return response(["message" => "Save successful"], Response::HTTP_CREATED);
            }else{
                throw new BadRequestException("Error on save new user");
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
            $user = User::findOrFail($id);
            return response()->json($user);
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
                'name' => 'required|max:255|min:4|unique:users,name,'.$id,
                'email' => 'required|email|unique:users,email,'.$id,
                'cpf' => 'required|digits:11|unique:users,cpf,'.$id,
            ]);
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
    
            $user->save();

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
            $user = User::findOrFail($id);
            $user->delete();
            return response(["message" => "Delete successful"], Response::HTTP_NO_CONTENT);
        }
        catch(\Exception $e){
            throw $e;//Exceptions/Handler.php
        }
    }
}
