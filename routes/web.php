<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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

Route::get('/secret-page', function () {
    return view('secret-page');
});


Route::get('contact', [ContactController::class, 'index'])->name('contact.create');

Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/message/{token}', [App\Http\Controllers\ContactController::class, 'show'])->name('secret-page');
