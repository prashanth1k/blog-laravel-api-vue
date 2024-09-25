<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {

        return 'register';
    }

    public function login()
    {
        return 'login';
    }

    public function logout()
    {
        return 'logout';
    }

    public function user()
    {
        return 'user';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function forgot()
    {
        return 'forgot';
    }

    public function reset()
    {
        return 'reset';
    }

    public function verify()
    {
        return 'verify';
    }

    public function sendVerification()
    {
        return 'sendVerification';
    }
}
