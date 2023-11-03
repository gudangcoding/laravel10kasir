<?php

use App\Http\Controllers\api\MemberController;
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

Route::get('produk',[ProdukController::class,'index']);
Route::post('/register', [OrderController::class, 'order']);

Route::group(['prefix' => '/member',], function () {
    Route::post('/register', [MemberController::class, 'register']);
    Route::post('/login', [MemberController::class, 'login']);
});
