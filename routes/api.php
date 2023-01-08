<?php

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

### mesma coisa que usar as rotas a baixo 
### Route::apiResource('/series', \App\Http\Controllers\Api\SeriesController::class);
Route::get('/series', [\App\Http\Controllers\Api\SeriesController::class, 'index']);
Route::post('/series', [\App\Http\Controllers\Api\SeriesController::class, 'store']);
Route::store('/series', [\App\Http\Controllers\Api\SeriesController::class, 'store']);
Route::show('/series', [\App\Http\Controllers\Api\SeriesController::class, 'show']);
Route::update('/series', [\App\Http\Controllers\Api\SeriesController::class, 'update']);
Route::destroy('/series', [\App\Http\Controllers\Api\SeriesController::class, 'destroy']);

Route::get('/series/{series}/seasons', function (\App\Models\Series $series) {
    return $series->seasons;
});

Route::get('/series/{series}/episodes', function (\App\Models\Series $series) {
    return $series->episodes;
});

Route::patch('/episodes/{episode}', function (\App\Models\Episode $episode, Request $request) {
    $episode->watched = $request->watched;
    $episode->save();

    return $episode;
});