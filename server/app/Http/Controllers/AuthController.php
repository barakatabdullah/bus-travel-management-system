<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function index(Request $request)
    {
        // $user= User::query()
        //     ->where('id','=',1);

        // return response()->json ;


    }


        public function create(Request $request)
        {
              /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    $valid = validator($request->only('email', 'name', 'password','mobile'), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'mobile' => 'required',
    ]);

    if ($valid->fails()) {
        $jsonError=response()->json($valid->errors()->all(), 400);
        return response()->json($jsonError);
    }

    $data = request()->only('email','name','password','mobile');

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'mobile' => $data['mobile']
    ]);


    // Fire off the internal request. 
    $token = $user->createToken('Token name')->accessToken;

    
            return response()->json(['data'=>['user'=>$user,'token'=>$token]], 201);
        }


}
