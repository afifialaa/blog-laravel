<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    /* public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = User::where('email', $request->email)->first();
            return response()->json(['token' => $user->api_token], 200);
        }
    } */

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if(Hash::check($request->password, $user->password)){
            return response()->json(['token'=> $user->createToken(time())->plainTextToken]);
        }


        return response()->json(['msg'=> 'Wrong email or password']);
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $token = Str::random(60);

        $user->api_token = Hash('sha256', $token);

        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json(['msg' => 'user already created'], 409);
            }
        }
        return response()->json(['token' => $user->api_token], 201);
    }
      
}
