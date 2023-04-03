<?php

use App\Http\Controllers\PostsApiController;
use App\Http\Controllers\InterventionController;
use App\Modeles\Intervention;
use App\Modeles\Post;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/posts', function() {
// 	return Post::all();
// });

Route::middleware(['cors'])->group(function () {
    Route::get('/dashboard/resume', [InterventionController::class, 'resume']);

    Route::get('/interveners', [InterventionController::class, 'getInterveners']);

    Route::get('/search', [InterventionController::class, 'search']);

    Route::get('/interventions', [InterventionController::class, 'getAll']);
    Route::get('/intervention/{intervention}', [InterventionController::class, 'getById']);
    Route::post('/interventions', [InterventionController::class, 'create']);
    Route::put('/intervention/{intervention}', [InterventionController::class, 'updateById']);
    Route::delete('/intervention/{intervention}', [InterventionController::class, 'deleteById']);
});


