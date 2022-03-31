<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\JournalEntryShareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', SignUpController::class);
Route::post('/login', LoginController::class);

Route::get('/journal-entries/shared/{public_id}', JournalEntryShareController::class);

Route::apiResource('journal-entries', JournalEntryController::class)->middleware('auth:sanctum');