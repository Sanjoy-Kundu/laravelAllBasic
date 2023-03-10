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











 ==================Last Steps  How to update image in laravel ========================
steps-01 Edit page e giye sokol information ante hobe .
steps-02 Akta new image file nite hobe file name dite hobe and form e enctype= "multipart/formdata" likte hobe
steps-03 ager file name and present file name akei dite hobe tahole code korte subidha hobe

PHOTO Upload er step amder duita , akta hoitece jodi default image thake tahole ak dhoroner query hobe , ar jodi user image dey tahole onno dhoroner query hobe .

FIRSTLY we want to check image first or secode time
steps-04 akhon amra chole jabo category controller ee jei method er moddey image update kora jay.
setps-05 aibar chek korbo je image ace ki na

            code     if($request->hasFile('category_image')){
                            echo "image ace";
                        }else{
                            echo "image nai";
                        }

akhon jodi image select kore tahole to output asbe image ace . tai akhon jehetu amr kace category_id ace tai ami sei data base e giye dekbo je image ta ki default image naki image upload korce .

   if($request->hasFile('category_image')){
            echo "image ace";
            echo $category_id;
            return Category::find($category_id)->category_image;

        }else{
            echo "image nai";
        }

       ********************* output e je image er name asbe sita ki default php******************
       amader check korte hobe je jodi image er name database er default image er sathe mile jay tahole seita hoitese fist time upload and jodi na mile tahole seita second time upload hobe .

            if($request->hasFile('category_image')){
            echo "image ace";
            echo $category_id;
             return Category::find($category_id)->category_image;
       $category = Category::find($category_id);
           return $category->category_image;
       if($category->category_image =='category_default.jpg'){
           echo "default photo";
       }else{
           echo "image dewa ace its second time update dite hobe ";
       }

       }else{
           echo "image nai";
       }




 ******************* =============Jodi default photo thake tahole amra just image upload kore database ke janiye dibo ====================********* jehetu amr image upload er code age lekha ace tai sei code copy korbo and kicu change korar dorkar nei karon same folder same image tai code copy kore database ke janiye dibo


 //image part start
            $imageName = Str::lower(Str::random(20)).".".$request->file('category_image')->extension();
            $imagePathName = "uploads/category_images/".$imageName;
        //watermark dewar jonno draw transparent text
        Image::make($request->file('category_image'))->text('Sanjoy Website', 0, 0, function($font) {
            $font->color([255, 255, 255, 0.5]);
        })->save($imagePathName);
        //image part end

               if($request->hasFile('category_image')){
       $category = Category::find($category_id);
       if($category->category_image =='category_default.jpg'){
        ******************************************************************
        start copy code and paste
   //===================image part start=====================
            $imageName = Str::lower(Str::random(20)).".".$request->file('category_image')->extension();
            $imagePathName = "uploads/category_images/".$imageName;
        //watermark dewar jonno draw transparent text
        Image::make($request->file('category_image'))->text('Sanjoy Website', 0, 0, function($font) {
            $font->color([255, 255, 255, 0.5]);
        })->save($imagePathName);
        //==================image part end======================

        //database jananor jonno
                //database start
                            Category::find($category_id)->update([
                                'category_image' =>$imageName
                            ]);
                            //database end
        //database e jananor joono
       }else{
        echo "second time";
       }
       }



       R jodi image second time hoy taole amder delete korte hobe orthat delete korar jonno unlink korte hobe
       jehetu not first time tai tumi bolo je kon photo ke ami delete korbo
            echo "not first time";
            echo $category->category_image;
            delete korar jonno unlik korbo
            unlink(')


            tobe akhon amder route link pete hobe route link powar jonno
            roture powar jonno amder asset er moddy link genaret korte hobe .

            SYSTEM NO _01 fist
                    echo $category->category_image;
                    echo   asset('uploads/category_images/').$category->category_image;
                    unlink(asset('uploads/category_images/').$category->category_image);
                    echo "unlink done";

                    aivabe dilam and output deklam output bola hoise unlink not allow akhon amder onno system dekte hobe


                    SYSTEM -02
                    amder akta function er moddhame korte hobe .
                    seita hoite public_path()
                    public_path(asset('uploads/category_images/).$category->category_image);
                    aita dile output ee folder soho dekhabe akhon aitake unlink folder er moddey rekhe dile kaj ses mane delete hobe
                    ai link genaret korbo
                    unlink(public_path('uploads/category_images/').$category->category_image);

                    *****************Code start ******************
                     function updateInfo(Request $request, $category_id){
                                                //image part start
                                                if($request->hasFile('category_image')){
                                                echo "image ace";
                                                    echo $category_id;
                                                return Category::find($category_id)->category_image;
                                                    $category = Category::find($category_id);
                                                    return $category->category_image;
                                                    if($category->category_image =='category_default.jpg'){
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
                                                    }else{
                                                        echo "not first time";
                                                        echo $category->category_image;
                                                            echo   asset('uploads/category_images/').$category->category_image;
                                                            echo "<br/>";
                                                            echo public_path('upload/category_images/').$category->category_image;
                                                            unlink(public_path('uploads/category_images/').$category->category_image);
                                                            echo "unlik done";
                                                    }
                                                    }
                                                        die();
                                                        //image part end
                                                            Category::find($category_id)->update([
                                                                "category_name" => $request->category_name,
                                                                "category_description" => $request->category_description,
                                                            ]);

                                                            return redirect('category/all');
                                                  }

                    ****************Code end ********************

                    akhon unlink howar por photo delete hoye jabe and then ki hobe abar databse e photo upload hobe edit korte parbo tar jonno
                    akhon amy akta ulta if linkte hobe




                    code cto korbo



                        function updateInfo(Request $request, $category_id){
        //image part start
        if($request->hasFile('category_image')){
          echo "image ace";
            echo $category_id;
             return Category::find($category_id)->category_image;
                    return $category->category_image;
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


13.========================================Category Image Adding System  End================================




                /*
                =======================Laravel image genaretor start===================================
                Just ami login korbo amar name er upor base kore image toyri hobe .
                seita amra korbo laravolt pacage er maddhome

                i. google ==> laravolt
                ii.  command dibo ==> composer require laravolt/avatar
                iii. add class config => app=> Laravolt\Avatar\ServiceProvider::class,
                iv. add class ==>app==> 'Avatar'    => Laravolt\Avatar\Facade::class,
                v. command ==> php artisan vendor:publish --provider="Laravolt\Avatar\ServiceProvider"

                vi. <img src="{{ Avatar::create('Joko Widodo')->toBase64() }}" /> to ===>  src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
   =======================Laravel image genaretor  end===================================










   =====================Adding Sweet alert ====================================

1. google ===> sweet alert.com ==> <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> copy kore amr page e anbo

2. sweet alert er page thke link er niche script er moddey
    <script>
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        )
    </script>
    code copy paste kore dekbo je kaj hoitece kina . link thik kore bosale obbosoi kaj korbe .

    3. amra link er niche @yield('sweetalert_script) likbo akhon je page sweet alert bosate cai sei page e jabo .

    4. sei page er akebare niche
     @section('sweetalert_script')
     testing er jonno
         <script>
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        )
    </script>
    likhe dekbo
    @endsection         likbo

    5. jekhane delete icon ace seita comment kore akta button nibo and seitar moddey sweet alert impliment korar chesta korbo
        <button><i class = 'btn btn-danger category_delete_btn'></button>

       steps-1  button er akta class name dibo and seitake sweet alert e dhorbo

       steps-02  niche js code likbo
            $ (document).ready(function(){
               //code likbo
            })

        steps-03 ki code likbo
            seita hoitece $ (button class name).click() koro, click korle akta alert dekhabe
                $ (.category_delete_btn).click(function(){    button class name == $category_delete_btn
                    alert('hello');
                               })


        steps-04 akon amra alert er poriborte sweet alert er code use korbo

        steps -05) akhon amke akta link ee hit korte hobe delete korar jonno tai age link toiri korte hobe.
            amader anchor tag e jei link ace sei link ke amra amder button er value te set kore dibo and anchor kr remore korbo.

        steps-06) akhon amder kaj hoitece je button e click korci sei button er value dhorte hobe value dhorbo js er moddey
        link dhorar jonno
        var link = $(this).val(); jake click korteco tar val take dhoro

        and bole dibo
        widow.location.href = link;
        taile amr sweet alert er kaj ses


=========================Adding sweet alert end =======================












===============================================================================================
HOW TO MAKE  VENDOR , USERS, ADMIN

What is vendor == labib group daraz plarform use kore bussniss korbe or product sell dibe. and daraz ke comission dibe . ai labib group hoitece vendor .

What is Admin == admin hoitece se sokol kicu chalaite parbe . Admin er kache sokol power thakbe .

User Hoitece == customer . customer ki korbe se registration kore product kinbe .
Amin vendor ke add korte parbe . vendor tar business chaite parbe .




Lets Play
Now go to the user table
seikhne giye amder kicu colum nite hobe (role) name akta colum nibo seitate bola thake ke admin ke vendor and ke customer
and aikhane amra soft delete user korbo

Lets add column
first one is
database ---> migration --> create_user_table seikhane giye table add korbo

at first amder role add korbo
         $table->string('role')->default('customer')->comment('admin, vendor, customer');
         role default hobe customer and commnet e bole dilam ata admin, vendor, customer hote pare

         and soft delete add korlam

rollback korbo and project abr chalabo
rollback korar age users table er batch ta bariye dibo mane databse e jabo --> migrate --> user --> batch-2

akhon registration kore deklam je database e role ase customer








HOW TO MAKE ADMIN ACCOUNT
1. admin accoutn jog korar jonno prothome je admin accoutn thake seita developer nije toiri kore dibe .
2. ami databaseee giye customer er jaygay akta admin likleo hobe kinto aivabe korbo na
3. amra latavel command er maddhome admin account banabo .

5. akhon ami user table ke migrate rollback korbo . rollback korbo karon amar je information ace seigulo delete kore dibo
6. akhon ami jodi code er maddhome table data insert korte cai tahole laravel e mojar kata jinish ace seita hoitece Seeder .

Akhon ai SEEDER er location kothery database --> seeders --> DatabaseSeeder.php
muloto amara seeder user kore code korbo then command er maddhome database e push korbo .

akhon ami php arisan migrate korbo  and ami chacchi database e akta data entry houk jetar role hobe admin
setar jonno
seps-01 php artisan kore debo je make: seeder name kono comment ace ki na

steps-02 ami seeder toyri kore database e data dhukaite cai tar jonno seeder kicu hishab nikash lagbo sei hishab nikash gulo pabo kothey hishab nikash pabo laravel er documentation eee

steps-03 - laravel.com --> seach (seeder)

steps-04 -- # Writing Seeders --> php artisan make:seeder UserSeeder ai command dibo
akhon dekbo -- database --> seeder --> userSeeder name akta seeder toyri hoise

steps-05
akhon Userseeder er moodey je code likbo sei code laravel documentation ee ace
laravel.com --> search --> seeders -->
                    DB::table('users')->insert([
                                'name' => Str::random(10),
                                'email' => Str::random(10).'@gmail.com',
                                'password' => Hash::make('password'),
                            ]);
ai sei code jeta amra UserSeeder e likbo

amra just jei bishoy tuku change korbo seita holo
                               DB::table('users')->insert([
                                'name' => 'admin',
                                'email' => 'admin@gmail.com',
                                'password' => Hash::make('123456789'),             //Database e je name ace seigula dilam r ki!
                                'created_at' => Carbon::now(),
                                 'role' => 'admin'
                            ]);




Akhon ami jodi ai code guloke chalate cai tahole amder DatabaseSeeder er kace jete hobe and seikhane giye je code likte hobe seita amder laravel documention e bola ace.

database ==> seeder ==> UserSeeder e giye

laravel.com theke  ==> search (seeder)
# Calling Additional Seeders
  $this->call([
        UserSeeder::class,
        PostSeeder::class,
        CommentSeeder::class,
    ]);

    theke just
       $this->call([
            UserSeeder::class,
        ]);
        rakbo


FINALLY JE COMMAD DILE CODE DHUKE JABE SEITA HOLO
Laravel.com ==> search(seeder) ==>
# Running Seeders
php artisan db:seed

==================================================================================================









==================================================================================================
Adding Vendor or Amin
add new user e form banabo
then seitake insert korbo
image er je file dibo seita kaj hoitece image dileo code kaj korbe na dileo kaj korbe

Image er jonno
At first amader database e image dhukaite hobe tar jonno
create_user e jabo
$table->text('profile_photo')->nullable();
profile name boro hoy dekhe amra text diye dilam
image faka hoile hobe nullable r image dile kaj korbe


jehetu image field ke database dhukaite hobe tai migrate rollback marte hobe


Amra je admin ba vendor banabo tar je password asbe seita randomly ase and database e auto genaret hobe .
tar mane age amake random password banate hobe

Password Genarate

    function insert(Request $request){
     return $request;

      return Str::upper(Str::random(8));
    }



    insert code
                    function insert(Request $request){
     // return $request;
       $user_genaret_password =  Str::upper(Str::random(8));

       User::insert([
        'name' =>$request->name,
        'email' =>$request->email,
        'password' =>$user_genaret_password,
         'password' =>bcrypt($user_genaret_password), //encrypted korar jonno
        'created_at' => Carbon::now(),
        'role' => $request->role
       ]);
       return back();
    }

    form fill kore database e pathalam kinto password encrypted hoy nai
    password encrypted korar jonno laravel ee bycryt name akta function ace
====================================================================================================













=============================================================================================
Akhon amr Dashboard e dekhate hobe koyta vendor koyta customer and koyjon user ace  .

Seita korar jonno
    first e amder collect korte hobe obbosho php code er moddey likte hobe .

    @php
        $user_collect = collect($all_user);
        @endphp

        and koto jon customer ace seita dekhanor jonno
        {{ $user_collect->where('role', 'customer')->count() }}

        koto jon vendor ace seita dekhanot jonno
         {{ $user_collect->where('role', 'vendor')->count() }}


         kotojon admin ace seita dekhanor jonno
          {{ $user_collect->where('role', 'admin')->count() }}





          Last Steps user from validatoin koralam jeita diye admin and vendor amra banabo
          User Controller ee

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

                */



?>
