<?php

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');    

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('/permission', App\Http\Controllers\PermissionController::class);
        Route::resource('/role', App\Http\Controllers\RoleController::class);
        Route::resource('/user', App\Http\Controllers\UserController::class);
        Route::resource('/tag', App\Http\Controllers\TagController::class);
        Route::resource('/category', App\Http\Controllers\CategoryController::class);
        Route::resource('/photo', App\Http\Controllers\PhotoController::class);
        Route::resource('/slider', App\Http\Controllers\SliderController::class);
        Route::resource('/video', App\Http\Controllers\VideoController::class);
        Route::resource('/post', App\Http\Controllers\PostController::class);
        Route::resource('/event', App\Http\Controllers\EventController::class);
    });
});


// Route::get('/',function(){
//     return view('auth.login');
// });
