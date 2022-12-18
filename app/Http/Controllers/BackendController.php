<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    function welcome(){
        return view('welcome');
    }

    function dashboard(){
        return view('dashboard');
    }

    function category(){
        $all_categories = Category::latest()->get();
        $trashed_categories = Category::onlyTrashed()->latest()->get();
        return view('Backend.category_list', compact('all_categories', 'trashed_categories'));
    }

    function addCategory(){
        return view('Backend.add_newCategory');
    }

}
