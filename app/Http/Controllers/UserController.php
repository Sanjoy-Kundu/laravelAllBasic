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
        $request->validate([
            'name' => 'required | max:25',
            'email' => 'required',
            'role' => 'required'
        ],
    [
        "name.required" => "Name field is required",
        'name.max' => "Name must be 25 characters",
        'email.required' => "Email field is required",
        'role.required' => 'User Role is required'
    ]);


       $user_genaret_password =  Str::upper(Str::random(8));

       User::insert([
        'name' =>$request->name,
        'email' =>$request->email,
        'password' =>bcrypt($user_genaret_password),
        'created_at' => Carbon::now(),
        'role' => $request->role
       ]);
       return back()->withSuccess('User Information inserted Successfully');
    }
}
