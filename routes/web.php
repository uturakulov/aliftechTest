<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhoneMailController;
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

Route::get('/', function () {
    return view('index');
});

Route::resource('/contacts', ContactController::class);
Route::get('/contacts/delete/{contact}', [ContactController::class, 'delete'])->name('contacts.delete');
Route::get('/archive/contacts', [ContactController::class, 'archived'])->name('contacts.archive');
Route::get('/contacts/archive/restore/{contact}', [ContactController::class, 'restore'])->name('contacts.restore');
Route::get('/contacts/archive/destroy/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

Route::resource('/details', PhoneMailController::class);
Route::get('/details/delete/{detail}', [PhoneMailController::class, 'delete'])->name('details.delete');
Route::get('/archive/details', [PhoneMailController::class, 'archived'])->name('details.archive');
Route::get('/details/archive/restore/{detail}', [PhoneMailController::class, 'restore'])->name('details.restore');
Route::get('/details/archive/destroy/{detail}', [PhoneMailController::class, 'destroy'])->name('details.destroy');
