<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ////-----------------------------------

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');


    Route::get('/pizzas',[PizzaController::class, 'index'])->name('pizzas.index');
    Route::post('/pizzas',[PizzaController::class, 'store'])->name('pizzas.store');
    Route::get('/pizzas/create', [PizzaController::class, 'create'])->name('pizzas.create');
    Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
    Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
    Route::get('/pizzas/{pizza}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');

    Route::get('/suppliers',[SupplierController::class, 'index'])->name('suppliers.index');
Route::post('/suppliers',[SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.new');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');

Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');

});

require __DIR__.'/auth.php';

