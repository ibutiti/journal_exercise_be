<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    /**
     * Handle the authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email'=> ['required', 'email'],
            'password' => ['required'],
        ]);
        $rememberMe = $request->boolean('rememberMe');

        if (!auth()->attempt($credentials, $rememberMe)){
            throw new AuthenticationException();
        }

        $request->session()->regenerate();
    }
}
