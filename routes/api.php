<?php

use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/produk',[ProdukController::class,'index']);
Route::post('/order', [OrderController::class, 'order']);
Route::post('/register', [MemberController::class, 'register']);
Route::post('/login', [MemberController::class, 'login']);

Route::group(['prefix' => '/member',], function () {
    
});
