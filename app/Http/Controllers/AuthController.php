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
    /**
     * @SWG\Post(
     *      path="/api/register",
     *      tags={"auth"},
     *      operationId="authLogin",
     *      summary="Register new user",
     *      consumes={"application/x-www-form-urlencoded"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="formData",
     *          required=true, 
     *          type="string" 
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="formData",
     *          required=true, 
     *          type="number" 
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Success"
     *      ),
     */
    /**
     * @OA\Post(
     * path="/api/register",
     * summary="Sign in",
     * description="Register new user with name, email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *   
     *    description="Enter user details",
     *    @OA\JsonContent(
     *       required={"name", "email","password", "password_comfirmation"},
     *       @OA\Property(property="name", type="string", example="John Doe"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *       
     *    ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Invalid  Details entered response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid user details details. ")
     *        )
     *     ),
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
    *        @OA\Property(property="token", type="object", example="2|fhfdnsnsnsnnsnsnsnns"),
    *     )
    *  ),
    * )
    */
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

    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *   
     *    description="Enter user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid Login details. ")
     *        )
     *     ),
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
    *        @OA\Property(property="token", type="object", example="2|fhfdnsnsnsnnsnsnsnns"),
    *     )
    *  ),
    * )
    */
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

    /**
     * @OA\Post(
     * path="/api/logout",
     * summary="Logout",
     * description="Logout user and invalidate token",
     * operationId="authLogout",
     * tags={"auth"},
     * security={ {"bearer": {} }},
     * @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * )
     * )
     */
    public function logout(){

        auth()->user()->tokens()->delete();

        return [
            'message'=>'logout successfull'
        ];
    }

}
