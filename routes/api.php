<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories',  'index' );
    Route::get('/categories/{id}',  'show' );
    Route::post('/categories',  'store' );
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});