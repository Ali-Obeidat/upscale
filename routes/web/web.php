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
    Route::resource('/employees', EmployeeController::class);

});
Auth::routes();

Route::middleware(['role:super admin','auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/companies', CompanyController::class);
    Route::resource('/roles', RoleController::class,);

    Route::put('admin/{role}/users/{id}', [EmployeeController::class ,'attachRole'])->name('user.attach.role');
    Route::put('admin/{role}/users/{id}/detach', [EmployeeController::class,'detachRole'])->name('user.detach.role');

});


