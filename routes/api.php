<?php



use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\UserApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/midtrans-callback', [App\Http\Controllers\Api\TransactionController::class, 'callback']);
Route::apiResource('/posts', TransactionApiController::class,array('as'=>'api'));
Route::apiResource('users', UserApiController::class,array('as'=>'api'));