<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\SalesController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\CategoryController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{category}', [CategoryController::class, 'show']);

Route::get('product/{product}', [ProductController::class, 'show']);


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    // Ventas:
    // POST Hacer compras LISTO
    Route::post('sales', [SalesController::class, 'store']);
    // GET Productos de la compras
    // GET Compras del usuario
    Route::get('usersales', [SalesController::class, 'getUserSales']);
});

Route::middleware(['isAPIAdmin', 'auth:sanctum'])->group(function () {

    Route::get('checkingAutenticated', function () {
        return response()->json(["message" => "Acceso permitido"], 200);
    });
    // Categorias:
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category/{category}', [CategoryController::class, 'update']);
    Route::delete('category/{category}', [CategoryController::class, 'destroy']);

    // Productos:
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{product}', [ProductController::class, 'update']);
    Route::delete('product/{product}', [ProductController::class, 'destroy']);

    // Ventas:
    Route::get('sales', [SalesController::class, 'index']);
    Route::get('sales/${sale}', [SalesController::class, 'show']);
    Route::get('product', [ProductController::class, 'index']);
    Route::put('sales/confirm={sale}', [SalesController::class, 'confirmSell']);
    Route::get('sales/confirmed={confirmed}', [SalesController::class, 'getSalesConfirmed']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


