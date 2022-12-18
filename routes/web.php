<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\categoryCotroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function () {
    return view('welcome');
});
/*  Route::get("/welcome", BackendController::class, 'welcome'); */
Route::get('dashboard',[BackendController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


//Backend Controller
Route::get('category/all', [BackendController::class, 'category']);
Route::get('category/add', [BackendController::class, 'addCategory']);

//Category
Route::post('category/insert', [CategoryController::class, 'insert']);
Route::get('category/edit/page/{category_id}', [CategoryController::class, 'editPage']);
Route::post('category/update/{category_id}', [CategoryController::class, 'updateInfo']);
Route::get('category/delete/{category_id}', [CategoryController::class, 'softDelete']);
Route::get('category/restore/{category_id}', [CategoryController::class, 'restore']);
Route::get('category/permanent/delete/{category_id}', [CategoryController::class, 'permanentDelete']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
