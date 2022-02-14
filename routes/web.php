<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\OrderController;


// Models
use App\Models\User as UserModel;
use Illuminate\Support\Facades\DB;

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
    return view('welcome');
})->name("welcome");

Route::get('/orders', [OrderController::class, 'publicViewOrder'])->name("public_view_orders");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = UserModel::all();
    // return view('dashboard', compact('users'));
    return view('admin.index');
})->name('dashboard');


//  Pizzas (CRUD)
Route::group(['middleware' => 'auth'], function () {
    Route::get("/pizza/all", [PizzaController::class, 'allPizza'])->name("all_pizza");
    
    Route::post("/pizza/add", [PizzaController::class, 'addPizza'])->name("add_pizza");
    
    Route::get("/pizza/edit/{id}", [PizzaController::class, 'editPizza']);
    
    Route::post("/pizza/update/{id}", [PizzaController::class, 'updatePizza'])->name('update_brand');
    
    Route::get("/pizza/delete/{id}", [PizzaController::class, 'deletePizza']);
});

// Orders
Route::group(['middleware' => 'auth'], function () {
    Route::get("/order/all", [OrderController::class, 'allOrders'])->name("all_orders");

    Route::post("/order/add", [OrderController::class, 'addOrder'])->name("add_order");

    Route::get("/order/edit/{id}", [OrderController::class, 'editOrder']);

    Route::post("/order/update/{id}", [OrderController::class, 'updateOrder'])->name('update_order');

    Route::get("/order/remove/{id}", [OrderController::class, 'removeOrder']);
    
    Route::get("/order/restore/{id}", [OrderController::class, 'restoreOrder']);
    
    Route::get("/order/delete/{id}", [OrderController::class, 'deleteOrder']);
});