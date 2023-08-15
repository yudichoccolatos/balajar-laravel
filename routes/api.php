<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\ReviewController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'Middleware' => 'api',
    'prefix'    => 'auth'
], function() {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});


Route::group([
    'Middleware' => 'api'
], function() {
    Route::resources([
        'categories'    => CategoryController::class,   
        'subcategories' => SubcategoryController::class,
        'sliders'       => SliderController::class,
        'products'       => ProductController::class,
        'members'       => MemberController::class,
        'testimonies'       => TestimoniController::class,
        'reviews'       => ReviewController::class,
        'orders'       => OrderController::class
    ]);

    Route::get('order/dikonfimasi', [OrderController::class, 'dikonfirmasi']);
    Route::get('order/dikemas', [OrderController::class, 'dikemas']);
    Route::get('order/dikirim', [OrderController::class, 'dikirim']);
    Route::get('order/diterima', [OrderController::class, 'diterima']);
    Route::get('order/selesai', [OrderController::class, 'selesai']);
    Route::get('order/ubah_status', [OrderController::class, 'ubah_status']);
    Route::get('reports', [ReportController::class, 'index']);
    
});