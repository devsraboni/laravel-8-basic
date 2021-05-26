<?php

use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return "this is home page";
})->middleware('age');


Route::get('/about', function(){
    return "this is about page";
})->middleware('age');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::get();
    return view('dashboard', compact('users'));
})->name('dashboard');
