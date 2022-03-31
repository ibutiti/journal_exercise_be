<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

class SignupController extends Controller
{
    /**
     * Handle the signup request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'name'=> ['required', 'string'],
            'email'=> ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $rememberMe = $request->boolean('rememberMe');
        $user = User::create([
            'name' => $credentials['name'], 
            'email'=> $credentials['email'], 
            'password'=>bcrypt($credentials['password'])
        ]);
        
        auth()->login($user, $rememberMe);
        
        return $user;

    }
}
