<?php
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    
    Route::resource('/posts', 'App\Http\Controllers\PostController');

    Route::get('admin/users/{user}/profile','App\Http\Controllers\userController@show')->name('user.profile');
    Route::put('admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    
    Route::get('admin/users/', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::delete('admin/users/{id}', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');

});