<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        return view('welcome');
    }

    function allUsers(){
        return view('Backend.users.all_users');
    }
}
