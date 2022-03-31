<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\JournalEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', SignUpController::class);
Route::post('/login', LoginController::class);

Route::apiResource('journal-entries', JournalEntryController::class)->middleware('auth:sanctum');