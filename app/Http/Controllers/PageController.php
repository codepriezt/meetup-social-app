<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function loginPage(){
        return view('general.login');
    }
    public function register(){
        return view('general.register');
    }

    public function forgetPassword(){
        return view('general.forget-password');
    }

    public function resetPasswordPage(){
        return view('general.reset-password');
    }

}
