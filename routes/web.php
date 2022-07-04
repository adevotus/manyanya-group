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
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// homepage route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'qoute']);

Route::get('/contact', [HomeController::class, 'contact']);


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

// Qouta view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:muhasibu|manager|superadmin']], function () {
    Route::get('/quotas', [QuotaController::class, 'index'])->name('quotes');
    Route::put('/quotas/{id}', [QuotaController::class, 'update'])->name('update');
    Route::delete('/quotas/{id}', [QuotaController::class, 'destroy'])->name('destroy');
});

// Cargo view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|muhasibu|manager|superadmin']], function () {
    Route::get('/cargos', [CargoController::class, 'cargos'])->name('cargos');
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos', [CargoController::class, 'update']);
    Route::delete('/cargos', [CargoController::class, 'destroy']);
});

// Garage view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:mechanics|storekeeper|muhasibu|manager|superadmin']], function () {
    Route::get('/garages', [GarageController::class, 'garages'])->name('garages');
    Route::post('/garages', [GarageController::class, 'store']);
    Route::put('/garages', [GarageController::class, 'update']);
    Route::delete('/garages', [GarageController::class, 'destroy']);

    Route::get('/garage/download/csv', [GarageController::class, 'downloadCSV'])->name('garages.downloadc');
    Route::get('/garage/download/excel', [GarageController::class, 'downloadExcel'])->name('garages.downloadx');
    Route::get('/garage/download/pdf', [GarageController::class, 'downloadPDF'])->name('garages.downloadp');
});

// Routes view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|muhasibu|manager|superadmin']], function () {
    Route::get('/routes', [RoutesController::class, 'routes'])->name('routes');

    Route::get('/add_routes', [RoutesController::class, 'create'])->name('routes.add');
    Route::post('/add_routes', [RoutesController::class, 'store']);

    Route::get('/{id}/show', [RoutesController::class, 'show'])->name('route.show');
    Route::post('/{id}/show', [RoutesController::class, 'sendMail']);
    Route::get('/{id}/print', [RoutesController::class, 'print'])->name('route.print');

    Route::get('/{id}/edit_routes', [RoutesController::class, 'edit'])->name('route.edit');
    Route::post('/{id}/edit_routes', [RoutesController::class, 'update']);

    Route::delete('/routes', [RoutesController::class, 'destroy']);

    Route::get('/route/download/csv', [RoutesController::class, 'downloadCSV'])->name('routes.downloadc');
    Route::get('/route/download/excel', [RoutesController::class, 'downloadExcel'])->name('routes.downloadx');
    Route::get('/route/download/pdf', [RoutesController::class, 'downloadPDF'])->name('routes.downloadp');
});

// Other Expenses view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|driver|mechanics|muhasibu|manager|superadmin']], function () {
    Route::get('/expenses', [ExpenseController::class, 'expense'])->name('expense');
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses', [ExpenseController::class, 'update']);
    Route::delete('/expenses', [ExpenseController::class, 'destroy']);

    Route::get('/expenses/download/csv', [ExpenseController::class, 'downloadCSV'])->name('expense.downloadc');
    Route::get('/expenses/download/excel', [ExpenseController::class, 'downloadExcel'])->name('expense.downloadx');
    Route::get('/expenses/download/pdf', [ExpenseController::class, 'downloadPDF'])->name('expense.downloadp');
});


Route::group(['prefix' => 'storekeeper', 'middleware' => ['auth', 'role:storekeeper|manager|superadmin']], function () {
    Route::get('/', [StoreController::class, 'index'])->name('store.home');
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
});

// Mechanics view, crud ops
Route::group(['prefix' => 'mechanics', 'middleware' => ['role:mechanics']], function () {
    Route::get('/', [MechanicsController::class, 'index'])->name('mechanics.home');
});

//Driver route
Route::group(['prefix' => 'driver', 'middleware' => ['role:driver']], function () {
    Route::get('/', [DriverController::class, 'index'])->name('driver.home');
    Route::post('/confirm/{id}', [DriverController::class, 'delivered'])->name('driver.deliver');
    Route::post('/', [DriverController::class, 'registration']);
    Route::put('/', [DriverController::class, 'route_confirmation']);
    Route::get('/profile', [DriverController::class, 'profile'])->name('driver.profile');
    Route::get('/acknowledgement', [DriverController::class, 'ack'])->name('driver.ack');
    Route::post('/check/{id}', [DriverController::class, 'updateVehicle'])->name('driver.check');
});


Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('', [AdminController::class, 'index'])->name('admin.home');
});

// Staff Member View,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:manager|superadmin']], function () {
    Route::get('/staff', [StaffController::class, 'staff'])->name('staff');
    Route::post('/staff', [StaffController::class, 'store']);
    Route::put('/staff', [StaffController::class, 'update']);
    Route::delete('/staff', [StaffController::class, 'destroy']);
});

// Driver view,Create,Update,Delete
Route::group(['prefix' => 'home', 'middleware' => ['auth', 'role:storekeeper|manager|superadmin']], function () {
    Route::get('/driver', [DriverController::class, 'driver'])->name('driver');
    Route::get('/certicicate/{id}', [DriverController::class, 'certificate'])->name('certificate.download');
    Route::get('/license/{id}', [DriverController::class, 'license'])->name('license.download');
    Route::post('/driver', [DriverController::class, 'store']);
    Route::put('/driver', [DriverController::class, 'update']);
    Route::delete('/driver', [DriverController::class, 'destroy']);
});
