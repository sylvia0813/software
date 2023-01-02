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
use App\Http\Controllers\MessageController;

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

    Route::get('message/index', [MessageController::class, 'index']);
    Route::get('message/send', [MessageController::class, 'send']);


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
        Route::prefix('/{order_id}')->group(function () {

            Route::get('/waiters', 'waiters')->name('waiters');

            // 服務生
            Route::prefix('/waiter/{waiter_id}')->name('waiter.')->group(function () {
                Route::post('/assign', 'assignWaiter')->name('assign');
                Route::post('/unassign', 'unassignWaiter')->name('unassign');
            });

            // 訂單餐點
            Route::prefix('/meal')->name('meal.')->controller(OrderMealController::class)->group(function () {
                // 新增
                Route::get('/index', 'index')->name('index');
                Route::post('/append', 'append')->name('append');

                // 訂單餐點狀態
                Route::prefix('{meal_id}')->group(function () {
                    // 刪除
                    Route::post('/remove', 'remove')->name('remove');
                    // 廚師
                    Route::post('/processing', 'processing')->name('processing');
                    Route::post('/finish', 'finish')->name('finish');
                    // 服務生
                    Route::post('/arrived', 'arrived')->name('arrived');
                });
            });
            // 訂單明細
            Route::get('/detail', 'detail')->name('detail');
            // 結帳
            Route::post('/checkout', 'checkout')->name('checkout');

            // 刪除
            Route::post('/delete', 'delete')->name('delete');
        });

        // 訂單列表
        Route::get('/list', [OrderController::class, 'list'])->name('list');
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

        // 桌面狀態
        Route::prefix('/{table_id}')->group(function () {
            Route::post('/update', 'update')->name('update');
            Route::get('/clean', 'clean')->name('clean');
        });
    });

    // 服務生
    Route::prefix('/waiter')->name('waiter.')->controller(WaiterController::class)->group(function () {
        Route::get('/status', 'index')->name('status');
    });
});
