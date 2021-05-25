<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'numeric|min:8',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number ? $request->mobile_number : null,
            'password' => Hash::make($request->password),
        ]);

        // grab user credentials
        $creds = $request->only(['email', 'password']);

        // generate token
        $token = auth()->attempt($creds);

        return response()->json(['status' => 'success']);
    }
}
