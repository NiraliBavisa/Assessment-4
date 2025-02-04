<?php

use App\Http\Resources\RegisterResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('resgister',RegisterResource::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
