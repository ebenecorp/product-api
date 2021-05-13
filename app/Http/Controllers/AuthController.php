<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //

    public function register (RegisterRequest $request){

        $fields = $request->all();

        $user =  User::create([
            'name'=> $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('product-api_app');

        $response = [
            'user'=> $user,
            'token' => $token->plainTextToken
        ];

        return response($response, 200);



    }

    public function login(LoginRequest $request){
        $fields = $request->all();

        // check for user 

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response(
                [
                    'message'=>'Invalid Login details'
                ], 401
            );
        }

        $token = $user->createToken('product-api_app');

        $response = [
            'user'=> $user,
            'token' => $token->plainTextToken
        ];

        return response($response, 200);

    }

    public function logout(){

        auth()->user()->tokens()->delete();

        return [
            'message'=>'logout successfull'
        ];
    }

}
