<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
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




// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'index'])->name('posts.show');
// Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');

Route::middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    // Route::resource('/posts', 'App\Http\Controllers\PostController');
    Route::resource('/companies', CompanyController::class,);
    Route::resource('/employees', EmployeeController::class,);
    Route::resource('/roles', RoleController::class,);

    Route::get('admin/users/{user}/profile','App\Http\Controllers\userController@show')->name('user.profile');
    Route::get('admin/users/{user}/profile','App\Http\Controllers\userController@show')->name('user.profile');
    Route::put('admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    
    Route::get('admin/users/', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::delete('admin/users/{id}', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');

    Route::put('admin/{role}/users/{id}', 'App\Http\Controllers\EmployeeController@attachRole')->name('user.attach.role');
    Route::put('admin/{role}/users/{id}/detach', 'App\Http\Controllers\EmployeeController@detachRole')->name('user.detach.role');
});
Auth::routes();

Route::middleware('role:Admin')->group(function(){
   
    
    Route::get('admin/users/', 'App\Http\Controllers\UserController@index')->name('users.index');

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['can:view,user','auth'])->group(function(){
   
    
    Route::get('admin/users/{user}/profile','App\Http\Controllers\userController@show')->name('user.profile');

});