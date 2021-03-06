<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Creates a new user
    function create(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->api_token = Str::random(60);


        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response('user already created', 409);
            }
        }

        return response($user->api_token, 201);
    }

    // Deletes user
    function delete(Request $request, $email){
        User::where('email', $email)->delete();
        return response('User was deleted', 200);
    }

    // Read by email
    function read(Request $request, $email){
        $user = User::where('email', $email)->firstOrFail();
        return $user;
    }

    function read_id(Request $request, $id){
        $user = User::find($id);
        return $user;
    }

    // Updates user password
    function update(Request $request){
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);

        $user->save();
    }

}
