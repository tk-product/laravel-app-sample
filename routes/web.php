<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogRequestResponse;
use App\Http\Controllers\VoiceInputController;
use App\Http\Controllers\RecipeController;

Route::middleware([LogRequestResponse::class])->group(
    function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/voice-input', [VoiceInputController::class, 'showForm']);
        // Route::post('/voice-input', [VoiceInputController::class, 'handleForm']);
        Route::post('/search', [RecipeController::class, 'search']);
    }
);
