<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
})->name('/home');


//posts routes for CRUD
Route::get('/post', [PostsController::class, 'index'])->name('post.index');
Route::post('/post/store', [PostsController::class, 'store'])->name('post.store');
Route::get('/post/edit/{id}', [PostsController::class, 'edit'])->name('post.edit');
Route::post('/post/update/{id}', [PostsController::class, 'update'])->name('post.update');
Route::delete('/post/delete/{id}', [PostsController::class, 'destroy'])->name('post.delete');
