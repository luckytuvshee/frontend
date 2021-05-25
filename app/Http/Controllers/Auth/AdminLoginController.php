<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth; // Facade

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            // attempt function automatically hashes and check
            return redirect()->intended(route('admin.dashboard')); // where they trying to go || go to dashboard
        }

        return redirect()->back()
                         ->withInput($request->only('email', 'remember'))
                         ->withErrors(['email' => 'Хэрэглэгчийн мэдээлэл таарахгүй байна']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
