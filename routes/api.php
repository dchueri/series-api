<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
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

Route::apiResource('/series', SeriesController::class);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index']);

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index']);
Route::put('/seasons/{season}/episodes', [EpisodesController::class, 'update']);
