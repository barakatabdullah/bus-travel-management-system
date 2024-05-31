<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{

public function getTickets(){

    try{

        $tickets = Ticket::with('trip','user')->get();
        return response()->json($tickets);
    }catch(\Exception $e) {
        return response()->json($e->getMessage(), 500);
       }
}

    public function create(Request $request){
        /**
            * Get a validator for an incoming registration request.
            *
            * @param  array  $request
            * @return \Illuminate\Contracts\Validation\Validator
            */
           $valid = validator($request->only('status','trip_id','user_id'), [
               'status' => 'required|boolean',
               'trip_id' => 'required|integer',
               'user_id' => 'required|integer',
           ]);

           if ($valid->fails()) {
               $jsonError = response()->json($valid->errors()->all(), 400);
               return response()->json($jsonError);
           }

          try{
           $data = $request->only('status','trip_id','user_id');

           $ticket = Ticket::create([
               'status' => $data['status'],
               'trip_id' => $data['trip_id'],
               'user_id' => $data['user_id']
           ]);



           return response()->json(['data' => ['ticket' => $ticket]], 201);
          } catch (\Exception $e) {
           return response()->json($e->getMessage(), 500);
          }
      }
}
