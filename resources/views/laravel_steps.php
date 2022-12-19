<?php
/*
Steps -01
1. at first database e submit korte hobe . tai php artisan migrate diye database create korte hobe.

2. laravel open kore sorbophrothom amder authentication add korte hobe [laravel bridge] laravel bridge open korar jonno jei steps gulo follow korte hobe .
    (i). laravel.com -> laravel bridge -> code copy composer paste.

3. laravel breeze install korar por amader login and signup form customize korte hobe .
    customize er jonno amder je html + css + js + other file jemon image aigula kothey rakbo aigula rakbo hosse public folder er moddey.

4. public folder e html + css + js + copy kora hoye gele , akhon login and registration customize korbo .
    tobe customize korar age login.blade.php  ke rename kore login_old.blade.php kore rekhe dibo . and register er same vabe korbo .


5. blade file e css + js + other file add korar koushol
 Example:
 <link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">


6. controller bananbo backend er data rakhar jonno backendController . and Frontend er data rakhar jonno Frontend Controller banabo
How to make controller :
    php artisan make:controller FrontendController (controller er C capital letter hobe)


7.akhon authentication korbo . jehetu login kore dashboard e jabe tai backendController e dashboard method create kore return kore dilam .



7. login korle dashboard e chole jabe sei dashboard ke intrigreate korlam . and dashboard er header == main-content == footer alada korbo .


8.header footer alada korar jonno
    resources => views => layouts==> aikhane ase akta file banabo dashboardMaster.blade.php (name is not mendotory)
    steps-1 => dashboard er header er code copy kore dashboard master e bosabo
    steps-2 => @yield('content') likbo
    steps-3 => footer er code cut kore bosabo


9 . akhon dashboard er header ananr jonno
    steps-1 => @extends('layouts.dashboardMaser')  likbo
    steps-2 => @section('content') dashboard code cut paste  @endsection likbo
    steps-3 => browser e giye code relode dibo



10. category niye kaj korbo
    category niye kaj korar jonno fist Controller banabo
    category er table create korar jonno categories name table create korbo .
    category name akta model toyri korlam


11. category + add new category er html content add korlam and link connect koralam


12. category adding system
                                        1. category ke add korbo BackendController e and add new category ke add korbo backendController eee
                                        2. category er data insert hobe categoryController eeee
                                        3. form er moddey jotogulo name field ace tar sob gulor name dibo and category controlller e ese return korbo retrun $request korbo .

                                        4. aibar validation korbo . tar purbe age database e category ke migrte korte hobe .
                                            create_categories e giye table er name dibo
                                            [laravel website e giye copy paste korbo.]
                                            laravel.com ===> search ==> (database migration ) likhe search korbo . schroll kore dekbo
                                            table name and databade name same dile valo hoy


                                        5. soft delete er jonno  laravel.com ===> search ==> soft deleting => ORM ee  jabo
                                        # Soft Deleting e asbo  seikhan theke dekhe dekhe impliment korbo



                                        6. return $request kore output dekbo and next validation korbo
                                            requird validation system =========

                                            $request-> validation([
                                                'name' => 'requird | max:35',
                                                'description' => 'request',
                                            ],
                                            [
                                                ========amader massege dekhar jonno =========
                                                'name.requird' => 'Name field is required',
                                                'name.max' => 'Name must be 35 characters',
                                                'description.requried' => 'Description field is required',
                                            ]);

                                            //inserting system
                                            Category::insert($request->except('token) + ['created_at =>Carbon::now();]) //carbon diye date and time dekbo
                                            return back()->withSuccess('category inserted successfully'); //alert massege dekhanor jonno


                                            7. AddCategroy page error massege dekhanor system
                                                @error('[input_name_field_name] categroy_name')
                                                    <span class ="text-danger">{{$message}}</span>
                                                @enderror

                                            8. slug add korar jonno laravel.com ==> search ==> slug likbo then  code copy kore bosabo name er jaygay $retrun -> category_name



                                            9. edit categroy page banabo and url diye link kore dibo
                                                function editPage($category_id){
                                        // echo $category_id;
                                            $editCategoryInfo = Category::find($category_id);
                                            return view('Backend.edit_category', compact('editCategoryInfo'));
                                        }


                                        10. update korar jonno akta route banabo then seitake CategoryController er kas theke update korbo .
                                                    function updateInfo(Request $request, $category_id){
                                                Category::find($category_id)->update([
                                                    "category_name" => $request->category_name,
                                                    "category_description" => $request->category_description,
                                                ]);

                                                return redirect('category/all');
                                        }
                                        update korar jonno $category id nibo and fisrt ee Category model er moddey theke find korbo then update korbo



                                        11. Delete korar jonno akta route nite hobe

                                        function softDelete($category_id){
                                            Category::find($category_id)->delete();
                                            return back()->withDeleting('Category delete successfully');
                                        }

                                    delete korar jonno category er moddey id dhore find koro then delete koro .








                                    ============================TRASHED CATEGORY RESTORE +=======================
                                    12 .  function restore($category_id){
                                            Category::onlyTrashed()->find($category_id)->restore();
                                            return back()->withTrashed('Yeah! Category restore successfully');
                                        }

                                        category ke only trashed er moddey theke find koro id diye and restore koro



                                        13.    function permanentDelete($category_id){
                                            Category::onlyTrashed()->find($category_id)->forceDelete();
                                            return back()->withTrashed("Category permanent deleted successfully");
                                        }

                                        category ke onlyTrashed er moddey theke find kore restore koro







13.========================================Category Image Adding System  start================================
                                    1. At first database e image field nite hobe
                                    2.tarpor add_category output e jiye image diye upload kore dekbo je database image soho data gece . and image upload na kore data submit korle error khabo .

                                    3bydedault image set korar system dekbo . orthat image select na korleo database e by default image  upload hobe . Now we can follow this steps now.







                                    =====================HOW TO SET DEFAULT CATEGORY IMAGHE START ===============
                                    migration table e jabbo sikhne
                                    $table-> string('category_image')->unique()->default('defaultcategory.jpg') dibo
                                    $table -> string('category_image')->default('defautlcategory.jpg);

                                    output dekhar jonno:
                                     php artisan migrate:rollback
                                    php artisan migrate
                                    =====================HOW TO SET DEAFUTL CATEGORY IMAGHE END===============








                                         ============MOST IMPORTANT=================
                                         je page e image er input thake sei form er enctype= 'multipart form/data kore dibo

                                        steps-1
                                                    photo rakhar jonno amake public folder moddey akta folder toyri kore defalut akta image rekhe dibo.

                                        steps-2
                                                public ==> uploads ==> category_images ==> category_default.jgp

                                        steps-3
                                                (checking image) image check korbo CategoryController er moddey
                                                return $request likeh image selete kore upload korle  output eeee {} curlybraches dekha jabe .
                                                image er name dekhar jonno return $request->file('image_name')  likbo. likle image er name dekhabe

                                        steps-4
                                            akhon amra check korbo je image ace ki na orthat ouptu ee jodi image thake tahole 1 dekhabo ar jodi na thake tahole 0 dekhabo . Atar joono hasFile() diye check korbo
                                            return $request -> hasFile('image name");


                                        steps-5
                                            if checking image
                                                   if($request->hasFile('category_image')){
                                                        echo "image ace";
                                                    }else{
                                                        echo "image nai";
                                                    }
                                            jodi amder image thake tahole amra sei minage ke database e bosabo . r image na thakle amra database bydefault image bosabo









                                        ===========THIRD PARTY START======================
                                        ********************************************************************************************
                                        jodi image dei tahole amder third party diye image upload er kaj ses korte hobe
                                        ********************************************************************************************
                                        THIRD PARTY name == https://intervention.io/
                                                                intervention.io ===> intervention image ==> read about laravel intrigration ===>  command er moddhome amader project ee add korte hobe .
                                                                (php composer.phar require intervention/image) ai hoitece link amra ai link theke add korbo na . link er last ee intervention/image royece aita hosscy github link . amra github theke add korar try korbo.
                                                                GITHUB LINK= https://github.com/intervention/image

                                                    amder project e add korar system ==> composer require intervention/image


                                        THIRD PARTY step-02
                                        intervention install korar por Integration in Laravel ee jabo seikhane bola ace amder kon folder er moddey ki ki add korte hobe =====>
                                                fisrt webiste dekhe

                                                    config/app.php folder er moodey jabo => seikhan theke $providers array te jabo seikhane Intervention\Image\ImageServiceProvider::class, add korbo sese comma dibo

                                                    NEXT: $aliases array te jabo and
                                                    'Image' => Intervention\Image\Facades\Image::class, add korbo

                                                    LAST
                                                    php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent" commad add korbo
                                       ========================== THIRD PARTY END======================




===============================HOW TO USES THIRD PARTY START=========================
            1. At first www.interventon.io ==> Uses_overview ==>
            Save an image in filesystem ==>  if condion er moddey Image::make('foo.jpg')->resize(300, 200)->save('bar.jpg'); bosabo


        2.
            if($request->hasFile('category_image')){
                echo "image ace";
                return $request->file('category_image');
            }else{
                echo "image nai";
            }

            jodi bole image ace taile  Image::make('foo.jpg')->resize(300, 200)->save('bar.jpg');  bosabo and resize kete dibo

        3.   if($request->hasFile('category_image')){
                echo "image ace";
                return $request->file('category_image'); ==>image name

                 Image::make('foo.jpg')->resize(300, 200)->save('bar.jpg');
                 Image::make($request->file('category_image'))->save('sanjjoy.jpg');
                 Image::make($request->file('category_image'))->save('uploads/category_images/sanjoy.jpg');
            }

        4. dewar por dekbo je image er niche lal dag asche aita dur koranor jonno
        Basic Usage==>  use Intervention\Image\ImageManagerStatic as Image; likbo

          taile dekbo je amr sanjoy.jpg name akta image asche public folder er moddey . akhon amy name generate korte hobe.


          5.Name generate
          Name generate korar jonno age photo path ke copy kore photo_path name akta variable e raklam

          $pathName = 'uploads/category_images/sanjoy.jpg'
          last  e je sanjoy.jpg ace aitake dynamic korbo tar jonno
          $imageNmae = $request->file('category_image)->extension().      extension ke nilam ;
          $imageName = ."."$request->file('category_image)->extension();   extension er sather .nilam
          $imageName  = Str::random(20)."."$request->file('category_image)->extension(); 20 digit er name genatet korlam ;
          $imageName = Str::lower(Str::random(20)."."$request->file('category_image)->extension()); lower case e rupantor korlam

               //checking image start
              if($request->hasFile('category_image')){

                $imageName = Str::lower(Str::random(20)).".".$request->file('category_image')->extension();
                $imagePathName = "uploads/category_images/".$imageName;
                Image::make($request->file('category_image'))->save($imagePathName);

            }

            die();




            6. ==================database e update korbo ==============
            step -01
                    database e update korar jonno  Category::insert ==> insert er por Category::insetGetId() diye dibo and aitake ata variable ee dibo

                    $categrory_id = Category::insertGetId(...)
                    and     if($request -> hasFile() er moddey ) echo $category_id;  kore dekbo id number koto .

                    akhon update korbo
                    Categoy::find($$category_image_id)->update([
                        'table_name' => ki update korbo $imageName
                        'category_image' => $imageName
                    ]);

                    Next category Model e giye category_image (table name) add kore dibo









                                                    $slug = Str::slug($request->category_name, '-');
                                                    $category_image_id = Category::insertGetId($request->except('_token') + [
                                                        'slug' => $slug,
                                                        'created_at' => Carbon::now()]);


                                                            //checking image start
                                                            if($request->hasFile('category_image')){
                                                                //image upload start
                                                                $imageName = Str::lower(Str::random(20)).".".$request->file('category_image')->extension();
                                                                $imagePathName = "uploads/category_images/".$imageName;
                                                                Image::make($request->file('category_image'))->save($imagePathName);
                                                                //image upload end

                                                                //database start
                                                                Category::find($category_image_id)->update([
                                                                    'category_image' =>$imageName
                                                                ]);
                                                                echo 'done';
                                                                //database end
                                                            }
                                                            //checking image end
                                                die();

                                                    return back()->withSuccess('Category Insert Successfully');
                                                    }





                        Image dekhnor jonno
<img src="{{ asset('uploads/category_images') }}/{{ $category->category_image }}"
                                                            class="img-fluid" alt="">
 ===============================HOW TO USES THIRD PARTY END=========================





13.========================================Category Image Adding System  End================================


                                        */








?>
