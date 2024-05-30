<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   public function getUsers(Request $request){
    // $users = User::orderBy("created_at","desc")->paginate(10);
    $users = User::with('roles')->get();
    return response()->json($users,200);
   }
   public function create(Request $request){
     /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $request
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $valid = validator($request->only('email', 'username' , 'phone',), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
        ]);

        if ($valid->fails()) {
            $jsonError = response()->json($valid->errors()->all(), 400);
            return response()->json($jsonError);
        }

       try{
        $data = $request->only('email', 'username', 'phone');

        $user = User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['phone']),
            'phone' => $data['phone']
        ]);




        $user->assignRole('passenger');


        return response()->json(['data' => ['user' => $user]], 201);
       } catch (\Exception $e) {
        return response()->json($e->getMessage(), 500);
       }
   }
}
