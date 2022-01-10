<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CrudController;
use App\Http\Controllers\API\AuthController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('home', [CrudController::class, 'index']);
    return auth()->user();
});

Route::get('show/{id}', [CrudController::class, 'show']);
Route::delete('delete/{id}', [CrudController::class, 'destroy']);
Route::post('store', [CrudController::class, 'store']);
Route::put('update/{id}', [CrudController::class, 'update']);



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);




Route::redirect('s', 'r', 401);
Route::view('URI', 'viewName', [], 200, []);

Route::middleware(['first', 'secned'])->group(function () {
    Route::view('URI', 'viewName', [], 200, []);
});
