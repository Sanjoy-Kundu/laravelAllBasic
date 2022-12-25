<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    function welcome(){
        return view('welcome');
    }

    function dashboard(){
        $all_categories = Category::latest()->get();
        $all_users = User::latest()->get();
        return view('dashboard', compact('all_categories', 'all_users'));
    }


    //user
    function allUsers(){
        $all_users = User::latest()->get();
        return view('Backend.users.all_users',compact('all_users'));
    }

function addUser(){
    return view('Backend.users.add_new_user');
}




//category
    function category(){
        $all_categories = Category::latest()->get();
        $trashed_categories = Category::onlyTrashed()->latest()->get();
        return view('Backend.category_list', compact('all_categories', 'trashed_categories'));
    }

    function addCategory(){
        return view('Backend.add_newCategory');
    }

}
