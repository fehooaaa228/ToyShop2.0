<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Review;
use App\Http\Controllers\GoodsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/add_review', [GoodsController::class, 'add_review']);

Route::get('/add_to_busket', [GoodsController::class, 'add_to_busket']);

Route::get('/delete_from_basket', [GoodsController::class, 'delete_from_basket']);

Route::post('/add_goods', [GoodsController::class, 'add_goods']);

Route::get('/delete_goods', [GoodsController::class, 'delete_goods']);