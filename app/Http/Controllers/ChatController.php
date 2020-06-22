<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function getAllContact(){
        $contact = User::all();
        return response()->json($contact);
    }
}
