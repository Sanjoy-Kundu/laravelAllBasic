<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Nette\Utils\Random;

class UserController extends Controller
{
    function index(){
        return view('welcome');
    }

    function allUsers(){
        return view('Backend.users.all_users');
    }


    function insert(Request $request){
     // return $request;
       $user_genaret_password =  Str::upper(Str::random(8));

       User::insert([
        'name' =>$request->name,
        'email' =>$request->email,
        'password' =>bcrypt($user_genaret_password),
        'created_at' => Carbon::now(),
        'role' => $request->role
       ]);
       return back();
    }
}
