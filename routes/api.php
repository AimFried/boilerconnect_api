<?php

namespace App\Http\Controllers;
use App\Modeles\Intervention;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;

Route::middleware(['cors'])->group(function () {
    Route::get('/statistics', [StatisticController::class, 'get']);
    Route::get('/intervener', [IntervenerController::class, 'get']);
    Route::get('/intervention', [InterventionController::class, 'get']);
    Route::get('/search', [InterventionController::class, 'search']);

    Route::post('/interventions', [InterventionController::class, 'create']);
    Route::delete('/intervention/{intervention}', [InterventionController::class, 'deleteById']);
});


