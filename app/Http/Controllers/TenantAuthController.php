<?php

// app/Http/Controllers/TenantAuthController.php
// app/Http/Controllers/TenantAuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Tenants.auth.login'); // make sure this exists
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
//        dd($credentials);
        if (Auth::guard('tenant')->attempt($credentials)) {
            return redirect()->intended('/'); // or wherever
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('tenant')->logout();
        return redirect('/login');
    }
}
