<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\muhasibu\muhasibuController;
use App\Http\Controllers\Storekeeper\PathrouterController;
use Illuminate\Support\Facades\Route;

// homepage route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact']);



Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'customRegistration']);
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');


// store keeper..
Route::get('/Pathroute', [PathrouterController::class, 'pathroute'])->middleware('auth')->name('pathroute');
Route::get('/sto-drivers', [PathrouterController::class, 'storedrivers'])->middleware('auth')->name('sto-drivers');



//manager route
Route::get('/drivers', [PageController::class, 'drivers'])->middleware('auth')->name('drivers');

//muhasibu route

Route::get('/invoice', [muhasibuController::class, 'invoice'])->middleware('auth')->name('invoice');
Route::get('/create-invoice', [muhasibuController::class, 'create_invoice'])->middleware('auth')->name('create-invoice');


Route::group(['prefix' => 'superadmin', 'middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('admin.home');
});
Route::group(['prefix' => 'storekeeper', 'middleware' => ['role:storekeeper']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('storekeeper.home');
});
Route::group(['prefix' => 'muhasibu', 'middleware' => ['role:muhasibu']], function () {
    Route::get('/', [muhasibuController::class, 'muhasibu'])->name('muhasibu.home');
});


Route::group(['prefix' => 'manager', 'middleware' => ['role:manager']], function () {
    Route::get('/managerboard', [PageController::class, 'manager'])->name('manager.home');
});

Route::group(['prefix' => 'driver', 'middleware' => ['role:driver']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('driver.home');
});
