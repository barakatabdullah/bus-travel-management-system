<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Expectation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class AuthController extends Controller
{




    public function create(Request $request)
    {
        // Get a validator for an incoming registration request.
        $validator = validator($request->only('email', 'username', 'password', 'phone', "password_confirmation"), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);

        if ($validator->fails()) {
            $jsonError = response()->json($validator->errors()->all(), 400);
            return response()->json($jsonError);
        }

        try {
            $data = $request->only('email', 'username', 'password', 'phone');

            $user = User::create([
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone' => $data['phone']
            ]);


            // Fire off the internal request.
            $token = $user->createToken('access')->accessToken;

            $user->assignRole('cashier');


            // event(new Registered($user));


            return response()->json(['data' => ['user' => $user, 'token' => $token]], 201);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function login(Request $request)
    {
        $valid = validator($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($valid->fails()) {
            $jsonError = response()->json($valid->errors()->all(), 400);
            return response()->json($jsonError);
        }

        try {
            $credentials = $request->only(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $user = auth()->user();
            $roles = $user->getRoleNames();
            $token = $user->createToken('access')->accessToken;
            return response()->json(['data' => ['user' => $user, 'token' => $token, 'roles' => $roles]], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }


    // public function verify(EmailVerificationRequest $request) {
    //     $request->fulfill();

    //     return response()->json(201);
    // }
}
