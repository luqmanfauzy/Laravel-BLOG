<?php

use App\Models\Post;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;

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

Route::get('/', [PostController::class,'index'])->name('home')->middleware('auth');

Route::get('/category/{id}', [PostController::class,'postCategories'])->name('category')->middleware('auth');

Route::get('/detail/{slug}', [PostController::class,'indexBySlug'])->name('detail')->middleware('auth');

Route::get('/author/{id}', [PostController::class,'indexById'])->name('')->middleware('auth');

Route::get('/register', [UserController::class,'indexRegister'])->name('register.form');
Route::post('/register', [UserController::class,'storeRegister'])->name('register.submit');

Route::get('/login', [UserController::class,'indexLogin'])->name('login.form')->middleware('guest');
Route::post('/login', [UserController::class,'authenticate'])->name('login.submit');

Route::post('/logout', [UserController::class,'logout'])->name('logout.submit');

//resource controller   
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('is_admin');

Route::resource('/dashboard', DashboardPostController::class)->middleware('auth');

Route::get('/verify', [UserController::class, 'verify'])->name('verify');
Route::post('/verify', [UserController::class, 'verifyPost'])->name('verify.post');
   
// Auth::routes(['verify'=> true]);