<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {return view('index');});
Route::post('store-data', [PostController::class, 'store'])->name('submitForm');
Route::get('get-posts', [PostController::class, 'index'])->name('getPosts');
Route::get('posts/{id}/editPage', function() {return view('editPage', ['id => $id']);})->name('editPage');

