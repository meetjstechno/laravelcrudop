<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


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

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('alreadyLogin');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register')->middleware('alreadyLogin');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('isLoggedin');
Route::get('post-dashboard', [AuthController::class, 'create']);
Route::post('post-dashboard', [AuthController::class, 'store']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('search', [AuthController::class, 'search']);
Route::get('showdata', [AuthController::class, 'showdata'])->name('showdata');
Route::get('edit/{id}', [AuthController::class, 'edit'])->name('edit');
Route::post('edit/{id}', [AuthController::class, 'update']);
Route::get('delete/{id}', [AuthController::class, 'delete'])->name('delete');