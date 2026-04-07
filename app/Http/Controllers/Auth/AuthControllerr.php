<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthControllerr extends Controller
{
public function Loginscreen()
    {
        return view("pages.auth.login");
    }

    public function Regiserscreen()
    {
        return view("pages.auth.register");
    }
}
