<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{


    function insert(Request $request){

        $request->validate([
           'category_name' => 'required |max:35',
            'category_description' => 'required',
        ],
    [
        'category_name.required' => 'Name field is required',
        'category_name.max' => 'Category name must be 35 characters',
        'category_description' => 'Category description is required',
    ]);


    $slug = Str::slug($request->category_name, '-');
    Category::insert($request->except('_token') + [
        'slug' => $slug,
        'created_at' => Carbon::now()]);


        //checking image start

    /*     if($request->hasFile('category_image')){
            echo "image ace";
        }else{
            echo "image nai";
        } */
        //checking image end

    return back()->withSuccess('Category Insert Successfully');
    }


    function editPage($category_id){
       // echo $category_id;
        $editCategoryInfo = Category::find($category_id);
        return view('Backend.edit_category', compact('editCategoryInfo'));
    }


    function updateInfo(Request $request, $category_id){
            Category::find($category_id)->update([
                "category_name" => $request->category_name,
                "category_description" => $request->category_description,
            ]);

            return redirect('category/all');
    }


    function softDelete($category_id){
        Category::find($category_id)->delete();
        return back()->withDeleting('Category delete successfully');
    }


    function restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->withTrashed('Yeah! Category restore successfully');
    }


    function permanentDelete($category_id){
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->withTrashed("Category permanent deleted successfully");
    }

}
