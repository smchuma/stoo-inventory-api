<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //

    public function register(Request $request){

        $fields = $request->validate([
            "first_name"=> "required|string|max:255",
            "last_name"=> "required|string|max:255",
            "email"=> "required|unique:suppliers,email",
            "password"=> "required",
           'phone_number' => [
                'required',
                'regex:/^0[67]\d{8}$/',
                'unique:suppliers,phone_number'
                ],
        ]);

        $user = User::create($fields);
        $token = $user->createToken($request->first_name);

        return [
            'token'=> $token->plainTextToken,
            'user'=> $user,
        ];
    }

    public function login(Request $request){

        $request->validate([
           "email"=> "required|email|exists:users",
           "password"=> "required"
       ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
           return [
               'message' => "The credentials provided are incorrect"
           ];
        }

        $token = $user->createToken($user->first_name);

        auth('web')->login($user);

        return response()->json([
            "token"=> $token->plainTextToken,
            "user" => $user,
        ],200);


   }
   public function logout(Request $request){

       $request->user()->tokens()->delete();
       auth("web")->logout();

       return [
           'message' => "you are logged out"
       ];
   }
}
