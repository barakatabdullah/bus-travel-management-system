<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{

    public function getBuses(Request $request){
        $buses = Bus::orderBy("created_at","desc")->paginate(10);
        return response()->json($buses,200);
       }
    public function create(Request $request){
        /**
            * Get a validator for an incoming registration request.
            *
            * @param  array  $request
            * @return \Illuminate\Contracts\Validation\Validator
            */
           $valid = validator($request->only('deriver', 'capacity' ), [
               'deriver' => 'required|string|max:255',
               'capacity' => 'required|integer',
           ]);
   
           if ($valid->fails()) {
               $jsonError = response()->json($valid->errors()->all(), 400);
               return response()->json($jsonError);
           }
   
          try{
           $data = $request->only('deriver', 'capacity');
   
           $bus = Bus::create([
               'deriver' => $data['deriver'],
               'capacity' => $data['capacity'],

           ]);
   

   
   
           return response()->json(['data' => ['bus' => $bus]], 201);
          } catch (\Exception $e) {
           return response()->json($e->getMessage(), 500);
          }
      }

}
