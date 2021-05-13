<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RegisterRequest;
use App\Http\Models\User;
use Illuminate\Support\Facade\Hash;


class AuthController extends Controller
{
    //

    public function register (RegisterRequest $request){

        $fields = $request->all();

        $user =  User::create([
            'name'=> $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcript($fields['password'])
        ]);

        $token = $user->createToken('product-api_app');

        $response = [
            'user'=> $user,
            'token' => $token->plainTexttoken
        ];

        return response($response, 200);



    }

}
