<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/github', [AuthController::class, 'redirectToGitHub'])->name('auth.github');
Route::get('/auth/github/callback', [AuthController::class, 'handleGitHubCallback']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/home', function () {
    return view('home');
})->name('home');
