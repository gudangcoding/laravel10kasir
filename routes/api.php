<?php

use App\Http\Controllers\api\KategoriController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/produk',ProdukController::class);
Route::get('/kategori',[KategoriController::class,'index']);


Route::post('/member/register', [MemberController::class, 'register']);
Route::post('/member/login', [MemberController::class, 'login']);


Route::post('/order', [OrderController::class, 'order']);

Route::group(['prefix' => '/member', 'middleware' => ['web']], function () {
    Route::post('/logout', [MemberController::class, 'logout']);
});

Route::group(['prefix' => '/member',], function () {
    
});
