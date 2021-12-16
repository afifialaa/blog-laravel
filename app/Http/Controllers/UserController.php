<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Creates a new user
    function create(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response('user was created', 201);
    }

    // Deletes user
    function delete(Request $request, $email){
        User::findOrFail($email)->delete();
        return response('User was deleted', 200);
    }

    // Read by email
    function read(Request $request, $email){
        $user = User::where('email', $email)->firstOrFail();
        return $user;
    }

    function read_id(Request $request, $id){
        $user = User::findOrFail($email)->delete();
        return $user;
    }

    // Updates user password
    function update(Request $request){
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);

        $user->save();
    }

}
