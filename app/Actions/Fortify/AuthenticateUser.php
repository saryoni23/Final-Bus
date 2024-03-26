<?php
// app/Actions/Fortify/AuthenticateUser.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function attemptLogin(Request $request)
    {
        return Auth::attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        );
    }

    public function handle(Request $request, $next)
    {
        if (! $this->attemptLogin($request)) {
            return back()->withErrors([
                'login' => 'Email atau password salah.',
            ]);
        }

        return $next($request);
    }
}
