<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [Postcontroller::class, 'index'])->name('home');
Route::get('/new', [Postcontroller::class, 'create'])->name('create');
Route::get('/details/{post}', [Postcontroller::class, 'show'])->name('show');
Route::get('/edit/{id}', [Postcontroller::class, 'edit'])->name('edit');

Route::post('/new', [Postcontroller::class, 'create_now']);
Route::post('/edit/{id}', [Postcontroller::class, 'update'])->name('update');

Route::delete('/delete/{id}', [Postcontroller::class, 'destroy'])->name('destroy');
