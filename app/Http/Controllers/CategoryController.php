<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

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
    $category_image_id = Category::insertGetId($request->except('_token') + [
        'slug' => $slug,
        'created_at' => Carbon::now()]);


              //checking image start
              if($request->hasFile('category_image')){
                //image upload start
                $imageName = Str::lower(Str::random(20)).".".$request->file('category_image')->extension();
                $imagePathName = "uploads/category_images/".$imageName;
               /*  Image::make($request->file('category_image'))->save($imagePathName);
               akdom last ee
                    // draw transparent text
                        $img->text('foo', 0, 0, function($font) {
                            $font->color([255, 255, 255, 0.5]);
                        });
               */

            //watermark dewar jonno draw transparent text
            Image::make($request->file('category_image'))->text('Sanjoy Website', 0, 0, function($font) {
                $font->color([255, 255, 255, 0.5]);
            })->save($imagePathName);
                //image upload end
                //database start
                Category::find($category_image_id)->update([
                    'category_image' =>$imageName
                ]);
                //database end
            }
    return back()->withSuccess('Category Insert Successfully');
    }


    function editPage($category_id){
       // echo $category_id;
        $editCategoryInfo = Category::find($category_id);
        return view('Backend.edit_category', compact('editCategoryInfo'));
    }


    function updateInfo(Request $request, $category_id){
        //image part start
        if($request->hasFile('category_image')){
        /*     echo "image ace";
            echo $category_id; */
       /*      return Category::find($category_id)->category_image; */
            /*         return $category->category_image; */
            $category = Category::find($category_id);

            if($category->category_image !='category_default.jpg'){
                unlink(public_path('uploads/category_images/').$category->category_image);
            }



            //image part start
            $imageName = Str::lower(Str::random(20)).".".$request->file('category_image')->extension();
            $imagePathName = "uploads/category_images/".$imageName;
        //watermark dewar jonno draw transparent text
        Image::make($request->file('category_image'))->text('Sanjoy Website', 0, 0, function($font) {
            $font->color([255, 255, 255, 0.5]);
        })->save($imagePathName);
        //image part end

                //database start
                Category::find($category_id)->update([
                    'category_image' =>$imageName
                ]);
                //database end

        }

        //image part end
            Category::find($category_id)->update([
                "category_name" => $request->category_name,
                "category_description" => $request->category_description,
            ]);

            return redirect('category/all');
    }




    //CATEGORY DELETE
    function softDelete($category_id){
        Category::find($category_id)->delete();
        return back()->withDeleting('Category delete successfully');
    }



    //CATEGORY RESTORE
    function restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->withTrashed('Yeah! Category restore successfully');
    }



    //CATEGORY PERMANENT DELETE
    function permanentDelete($category_id){
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->withTrashed("Category permanent deleted successfully");
    }

}
