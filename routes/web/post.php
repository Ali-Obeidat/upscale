<?php
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::resource('/posts', 'App\Http\Controllers\PostController');
