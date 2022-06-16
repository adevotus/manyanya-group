<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ManagerController;
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
Route::POST('/', [HomeController::class, 'CustomerRequest'])->name('home');


Auth::routes();

//Profile & Settings route
Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'role:muhasibu|driver|storekeeper|manager|superadmin']], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('settings');
    Route::post('/', [ProfileController::class, 'update']);
    Route::put('/', [ProfileController::class, 'password']);
});

//Super Admin Route
Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('', [AdminController::class, 'index'])->name('admin.home');

    // Vehicle view,Create,Update,Delete
    Route::get('/vehicle', [AdminController::class, 'vehicle'])->name('admin.vehicle');
    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('/vehicle', [VehicleController::class, 'update']);
    Route::delete('/vehicle', [VehicleController::class, 'destroy']);

    // Driver view,Create,Update,Delete
    Route::get('/driver', [AdminController::class, 'driver'])->name('admin.driver');
    Route::get('/certicicate/{id}', [AdminController::class, 'certificate'])->name('admin.certificate.download');
    Route::get('/license/{id}', [AdminController::class, 'license'])->name('admin.license.download');
    Route::post('/driver', [DriverController::class, 'store']);
    Route::put('/driver', [DriverController::class, 'update']);
    Route::delete('/driver', [DriverController::class, 'destroy']);

    // Staff Member View,Create,Update,Delete
    Route::get('/staff', [AdminController::class, 'staff'])->name('admin.staff');
    Route::post('/staff', [StaffController::class, 'store']);
    Route::put('/staff', [StaffController::class, 'update']);
    Route::delete('/staff', [StaffController::class, 'destroy']);

    // Routes view,Create,Update,Delete
    Route::get('/routes', [AdminController::class, 'routes'])->name('admin.routes');
    Route::post('/routes', [RoutesController::class, 'store']);
    Route::put('/routes', [RoutesController::class, 'update']);
    Route::delete('/routes', [RoutesController::class, 'destroy']);

    // Cargo view,Create,Update,Delete
    Route::get('/cargos', [AdminController::class, 'cargos'])->name('admin.cargos');
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos', [CargoController::class, 'update']);
    Route::delete('/cargos', [CargoController::class, 'destroy']);

    // Garage view,Create,Update,Delete
    Route::get('/garages', [AdminController::class, 'garages'])->name('admin.garages');
    Route::post('/garages', [GarageController::class, 'store']);
    Route::put('/garages', [GarageController::class, 'update']);
    Route::delete('/garages', [GarageController::class, 'destroy']);
});


// Store keeper route
Route::group(['prefix' => 'storekeeper', 'middleware' => ['auth', 'role:storekeeper|manager|superadmin']], function () {
    Route::get('/', [StoreController::class, 'index'])->name('store.home');

    // Vehicle view,Create,Update,Delete
    Route::get('/vehicle', [StoreController::class, 'vehicle'])->name('store.vehicle');
    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('/vehicle', [VehicleController::class, 'update']);
    Route::delete('/vehicle', [VehicleController::class, 'destroy']);

    // Driver view,Create,Update,Delete
    Route::get('/driver', [StoreController::class, 'driver'])->name('store.driver');
    Route::get('/certicicate/{id}', [StoreController::class, 'certificate'])->name('store.certificate.download');
    Route::get('/license/{id}', [StoreController::class, 'license'])->name('store.license.download');
    Route::post('/driver', [DriverController::class, 'store']);
    Route::put('/driver', [DriverController::class, 'update']);
    Route::delete('/driver', [DriverController::class, 'destroy']);

    // Routes view,Create,Update,Delete
    Route::get('/routes', [StoreController::class, 'routes'])->name('store.routes');
    Route::post('/routes', [RoutesController::class, 'store']);
    Route::put('/routes', [RoutesController::class, 'update']);
    Route::delete('/routes', [RoutesController::class, 'destroy']);

    // Cargo view,Create,Update,Delete
    Route::get('/cargos', [StoreController::class, 'cargos'])->name('store.cargos');
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos', [CargoController::class, 'update']);
    Route::delete('/cargos', [CargoController::class, 'destroy']);

    // Garage view,Create,Update,Delete
    Route::get('/garages', [StoreController::class, 'garages'])->name('store.garages');
    Route::post('/garages', [GarageController::class, 'store']);
    Route::put('/garages', [GarageController::class, 'update']);
    Route::delete('/garages', [GarageController::class, 'destroy']);
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

    // Vehicle view,Create,Update,Delete
    Route::get('/vehicle', [ManagerController::class, 'vehicle'])->name('manager.vehicle');
    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('/vehicle', [VehicleController::class, 'update']);
    Route::delete('/vehicle', [VehicleController::class, 'destroy']);

    // Driver view,Create,Update,Delete
    Route::get('/driver', [ManagerController::class, 'driver'])->name('manager.driver');
    Route::get('/certicicate/{id}', [ManagerController::class, 'certificate'])->name('manager.certificate.download');
    Route::get('/license/{id}', [ManagerController::class, 'license'])->name('manager.license.download');
    Route::post('/driver', [DriverController::class, 'store']);
    Route::put('/driver', [DriverController::class, 'update']);
    Route::delete('/driver', [DriverController::class, 'destroy']);

    // Routes view,Create,Update,Delete
    Route::get('/routes', [ManagerController::class, 'routes'])->name('manager.routes');
    Route::post('/routes', [RoutesController::class, 'store']);
    Route::put('/routes', [RoutesController::class, 'update']);
    Route::delete('/routes', [RoutesController::class, 'destroy']);

    // Cargo view,Create,Update,Delete
    Route::get('/cargos', [ManagerController::class, 'cargos'])->name('manager.cargos');
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos', [CargoController::class, 'update']);
    Route::delete('/cargos', [CargoController::class, 'destroy']);

    // Garage view,Create,Update,Delete
    Route::get('/garages', [ManagerController::class, 'garages'])->name('manager.garages');
    Route::post('/garages', [GarageController::class, 'store']);
    Route::put('/garages', [GarageController::class, 'update']);
    Route::delete('/garages', [GarageController::class, 'destroy']);
});


//Driver route
Route::group(['prefix' => 'driver', 'middleware' => ['role:driver']], function () {
    Route::get('/', [DriverController::class, 'index'])->name('driver.home');
    Route::post('/', [DriverController::class, 'registration']);
    Route::put('/', [DriverController::class, 'route_confirmation']);
});
