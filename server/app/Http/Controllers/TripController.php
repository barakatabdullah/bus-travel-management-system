<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{

    public function getTrips(Request $request){
        $trips = Trip::with('bus')->orderBy("created_at","desc")->paginate(10);
        return response()->json($trips,200);
       }
    public function create(Request $request){
        /**
            * Get a validator for an incoming registration request.
            *
            * @param  array  $request
            * @return \Illuminate\Contracts\Validation\Validator
            */
           $valid = validator($request->only('name', 'active', 'bus_id', 'time'), [
               'name' => 'required|string|max:255',
               'active' => 'boolean', 
               'bus_id' => 'required|integer', 
               'time' => 'date', 
           ]);
   
           if ($valid->fails()) {
               $jsonError = response()->json($valid->errors()->all(), 400);
               return response()->json($jsonError);
           }
   
          try{
           $data = $request->only('name', 'active', 'bus_id', 'time');
   
           $trip = Trip::create([
               'name' => $data['name'],
               'active' => $data['active'],
               'time' => $data['time'],
               'bus_id' => $data['bus_id']
           ]);
   
   
   
   
           return response()->json(['data' => ['trip' => $trip]], 201);
          } catch (\Exception $e) {
           return response()->json($e->getMessage(), 500);
          }
      }
}
