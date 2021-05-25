<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // grab user credentials
        $creds = $request->only(['email', 'password']);

        // generate token
        if(!$token = auth()->attempt($creds))
        {
            return response()->json(['error' => 'Incorrect email/password'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function load_user(Request $request)
    {
        try {
            $user = auth()->userOrFail();
        }
        catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if($request->formData['first_name'])
        {
            $user->first_name = $request->formData['first_name'];
        }

        if($request->formData['last_name'])
        {
            $user->last_name = $request->formData['last_name'];
        }

        if($request->formData['mobile_number'])
        {
            $user->mobile_number = $request->formData['mobile_number'];
        }

        if($request->formData['password'])
        {
            $user->password = Hash::make($request->formData['password']);
        }

        $user->save();

        return auth()->userOrFail();
    }
}
