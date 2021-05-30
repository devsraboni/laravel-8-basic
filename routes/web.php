<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

// Category Routes
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/softdelete/{id}', [CategoryController::class, 'softDelete'])->name('category.softdelete');
Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

// Brand Routes
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');


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
