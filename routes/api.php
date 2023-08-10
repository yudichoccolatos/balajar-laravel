<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'Middleware' => 'api',
    'prefix'    => 'auth'
], function() {
    Route::post('login', [AuthController::class, 'login'])->name('login');
}
);
