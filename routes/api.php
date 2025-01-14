<?php

use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('clients', ClientController::class);
Route::post('clients/{client}/contact', ClientContactController::class);