<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MechanicsController;
use App\Http\Controllers\MuhasibuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// homepage route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact']);
Route::POST('/', [HomeController::class, 'CustomerRequest']);


Auth::routes();

//Profile & Settings route
Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'role:mechanics|muhasibu|driver|storekeeper|manager|superadmin']], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('settings');
    Route::post('/', [ProfileController::class, 'update']);
    Route::put('/', [ProfileController::class, 'password']);
});


Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:mechanics|manager|superadmin']], function () {
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle');
    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('/vehicle', [VehicleController::class, 'update']);
    Route::delete('/vehicle', [VehicleController::class, 'destroy']);
});

// Cargo view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|manager|superadmin']], function () {
    Route::get('/cargos', [CargoController::class, 'cargos'])->name('cargos');
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos', [CargoController::class, 'update']);
    Route::delete('/cargos', [CargoController::class, 'destroy']);
});

// Garage view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:mechanics|manager|superadmin']], function () {
    Route::get('/garages', [GarageController::class, 'garages'])->name('garages');
    Route::post('/garages', [GarageController::class, 'store']);
    Route::put('/garages', [GarageController::class, 'update']);
    Route::delete('/garages', [GarageController::class, 'destroy']);
});

// Routes view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|muhasibu|manager|superadmin']], function () {
    Route::get('/routes', [RoutesController::class, 'routes'])->name('routes');
    Route::post('/routes', [RoutesController::class, 'store']);
    Route::put('/routes', [RoutesController::class, 'update']);
    Route::delete('/routes', [RoutesController::class, 'destroy']);
});

// Other Expenses view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|driver|mechanics|muhasibu|manager|superadmin']], function () {
    Route::get('/expenses', [ExpenseController::class, 'expense'])->name('expense');
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses', [ExpenseController::class, 'update']);
    Route::delete('/expenses', [ExpenseController::class, 'destroy']);
});


Route::group(['prefix' => 'storekeeper', 'middleware' => ['auth', 'role:storekeeper|manager|superadmin']], function () {
    Route::get('/', [StoreController::class, 'index'])->name('store.home');

    // Driver view,Create,Update,Delete
    Route::get('/driver', [StoreController::class, 'driver'])->name('store.driver');
    Route::get('/certicicate/{id}', [StoreController::class, 'certificate'])->name('store.certificate.download');
    Route::get('/license/{id}', [StoreController::class, 'license'])->name('store.license.download');
    Route::post('/driver', [DriverController::class, 'store']);
    Route::put('/driver', [DriverController::class, 'update']);
    Route::delete('/driver', [DriverController::class, 'destroy']);
});


//muhasibu route
Route::group(['prefix' => 'muhasibu', 'middleware' => ['role:muhasibu']], function () {
    Route::get('/', [MuhasibuController::class, 'index'])->name('muhasibu.home');
    Route::post('/', [MuhasibuController::class, 'update']);

    Route::get('/invoices', [MuhasibuController::class, 'invoice'])->name('muhasibu.invoice');
    Route::post('/invoices', [MuhasibuController::class, 'store']);

    Route::get('/garage', [MuhasibuController::class, 'garage'])->name('muhasibu.garage');
    Route::post('/garage', [MuhasibuController::class, 'tool_store']);
});

// Manager Route
Route::group(['prefix' => 'manager', 'middleware' => ['role:manager']], function () {
    Route::get('/', [ManagerController::class, 'index'])->name('manager.home');

    // Driver view,Create,Update,Delete
    Route::get('/driver', [ManagerController::class, 'driver'])->name('manager.driver');
    Route::get('/certicicate/{id}', [ManagerController::class, 'certificate'])->name('manager.certificate.download');
    Route::get('/license/{id}', [ManagerController::class, 'license'])->name('manager.license.download');
    Route::post('/driver', [DriverController::class, 'store']);
    Route::put('/driver', [DriverController::class, 'update']);
    Route::delete('/driver', [DriverController::class, 'destroy']);
});

// Mechanics view, crud ops
Route::group(['prefix' => 'mechanics', 'middleware' => ['role:mechanics']], function () {
    Route::get('/', [MechanicsController::class, 'index'])->name('mechanics.home');
});




//Driver route
Route::group(['prefix' => 'driver', 'middleware' => ['role:driver']], function () {
    Route::get('/', [DriverController::class, 'index'])->name('driver.home');
    Route::post('/', [DriverController::class, 'registration']);
    Route::put('/', [DriverController::class, 'route_confirmation']);
});
