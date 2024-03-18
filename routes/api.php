<?php

use App\Http\Controllers\PersonController;
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

Route::get('/people', [PersonController::class, 'index']);
Route::get('/people/{id}', [PersonController::class, 'find'])->where('id', '[0-9]+');
Route::post('/people', [PersonController::class, 'create']);
Route::put('/people/{id}', [PersonController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/people/{id}', [PersonController::class, 'delete'])->where('id', '[0-9]+');