<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderMealController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include 'auth.php';

Route::middleware(['auth'])->group(function () {
    // 首頁
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 點餐
    Route::prefix('/order')->name('order.')->group(function () {
        // 入桌
        Route::prefix('/table/{table_id}')->group(function () {
            Route::get('/index', [OrderController::class, 'index'])->name('index');
            Route::post('/new', [OrderController::class, 'new'])->name('new');
        });

        // Route::get('/{order_id}/detail', [OrderController::class, 'detail'])->name('detail');

        // 訂單列表
        Route::get('/list', [OrderController::class, 'list'])->name('list');

        // 訂單餐點狀態
        Route::prefix('/order_meal/{order_meal_id}')->name('meal.')->group(function () {
            Route::post('/processing', [OrderMealController::class, 'processing'])->name('processing');
            Route::post('/finish', [OrderMealController::class, 'finish'])->name('finish');
        });
    });

    // 桌面
    Route::prefix('/table')->name('table.')->group(function () {
        Route::get('/status', [TableController::class, 'index'])->name('status');
        Route::post('/{table_id}/update', [TableController::class, 'update'])->name('update');
    });

    // 庫存
    Route::prefix('/meal')->name('meal.')->group(function () {
        Route::get('/list', [MealController::class, 'list'])->name('list');
        Route::post('/{meal_id}/update', [MealController::class, 'update'])->name('update');
    });

    // 銷售
    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/index', [DashboardController::class, 'index'])->name('index');
    });

    // 成員
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('list');
        Route::post('/{user_id}/update', [UserController::class, 'update'])->name('update');
    });
});