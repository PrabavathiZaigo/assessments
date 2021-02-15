<?php


use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ManagerController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\ProductsController;

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

Route::get('index',[ProductsController::class,'index'])->name('index');
Route::get('create',[ProductsController::class,'create'])->name('create')->middleware('auth');
Route::post('store',[ProductsController::class,'store'])->name('store');


Route::group(['prefix' => 'admins', 'as' => 'admins.','middleware' => ['auth','role']],
function (){
    Route::get('index',[AdminController::class,'index'])->name('index');
    Route::get('create',[AdminController::class,'create'])->name('create');
    Route::post('store',[AdminController::class,'store'])->name('store');
    Route::put('update',[AdminController::class,'update'])->name('update');
    Route::delete('destroy/{id}',[AdminController::class,'destroy'])->name('destroy');
    Route::get('show',[AdminController::class,'show'])->name('show');
    Route::get('edit/{id}',[AdminController::class,'edit'])->name('edit');

});


Route::group(['prefix' => 'managers', 'as' => 'managers.', 'middleware' => ['auth','role']],
function (){
    Route::get('index',[ManagerController::class,'index'])->name('index');
    Route::get('create',[ManagerController::class,'create'])->name('create');
    Route::post('store',[ManagerController::class,'store'])->name('store');
    Route::put('update',[ManagerController::class,'update'])->name('update');
    Route::delete('destroy/{id}',[ManagerController::class,'destroy'])->name('destroy');
    Route::get('show',[ManagerController::class,'show'])->name('show');
    Route::get('edit/{id}',[ManagerController::class,'edit'])->name('edit');

});


Route::group(['prefix' => 'customers', 'as' => 'customers.', 'middleware' => ['auth',]],
function (){
    Route::get('index',[CustomerController::class,'index'])->name('index');
    Route::get('create',[CustomerController::class,'create'])->name('create');
    Route::post('store',[CustomerController::class,'store'])->name('store');
    Route::put('update',[CustomerController::class,'update'])->name('update');
    Route::delete('destroy/{id}',[CustomerController::class,'destroy'])->name('destroy');
    Route::get('show',[CustomerController::class,'show'])->name('show');
    Route::get('edit/{id}',[CustomerController::class,'edit'])->name('edit');

});


Route::group(['prefix' => 'products', 'as' => 'products.'],
function (){
    Route::get('index',[ProductController::class,'index'])->name('index');
    Route::get('create',[ProductController::class,'create'])->name('create');
    Route::post('store',[ProductController::class,'store'])->name('store');
    Route::put('update',[ProductController::class,'update'])->name('update');
    Route::delete('destroy/{id}',[ProductController::class,'destroy'])->name('destroy');
    Route::get('show',[ProductController::class,'show'])->name('show');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
