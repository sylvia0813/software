<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderMealController;
use App\Http\Controllers\OrderReservedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaiterController;

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

Route::redirect('/', '/home', 301);

Route::middleware(['auth'])->group(function () {
    // 首頁
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 訂單
    Route::prefix('/order')->name('order.')->controller(OrderController::class)->group(function () {
        // 入桌
        Route::prefix('/table/{table_id}')->group(function () {
            // 點餐
            Route::get('/index', 'index')->name('index');
            Route::post('/new', 'new')->name('new');
        });

        // 訂位
        Route::prefix('/reserved/{table_id}')->name('reserved.')->controller(OrderReservedController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cancel', 'cancel')->name('cancel');
        });

        // 訂單
        Route::prefix('/{order_id}')->controller(OrderController::class)->group(function () {
            // 訂單明細
            Route::get('/detail', 'detail')->name('detail');
            // 結帳
            Route::post('/checkout', 'checkout')->name('checkout');
        });

        // 訂單列表
        Route::get('/list', [OrderController::class, 'list'])->name('list');

        // 訂單餐點狀態
        Route::prefix('/order_meal/{order_meal_id}')->name('meal.')->controller(OrderMealController::class)->group(function () {
            // 廚師
            Route::post('/processing', 'processing')->name('processing');
            Route::post('/finish', 'finish')->name('finish');
            // 服務生
            Route::post('/arrived', 'arrived')->name('arrived');
        });
    });

    // 庫存
    Route::prefix('/meal')->name('meal.')->controller(MealController::class)->group(function () {
        Route::get('/list', 'list')->name('list');
        Route::post('/{meal_id}/update', 'update')->name('update');
    });

    // 銷售
    Route::prefix('/dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
        Route::get('/index',  'index')->name('index');
    });

    // 成員
    Route::prefix('/user')->name('user.')->controller(UserController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::post('/{user_id}/update', 'update')->name('update');
    });

    // 桌面
    Route::prefix('/table')->name('table.')->controller(TableController::class)->group(function () {
        Route::get('/status', 'index')->name('status');
        Route::post('/{table_id}/update', 'update')->name('update');
    });

    // 服務生
    Route::prefix('/waiter')->name('waiter.')->controller(WaiterController::class)->group(function () {
        Route::get('/status', 'index')->name('status');
    });
});