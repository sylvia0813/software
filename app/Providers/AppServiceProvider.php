<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 領檯人員,服務生,廚師,雜工,經理
        // server,waiter,chef,handyman,manager

        // 點餐頁面
        Gate::define('order_page', function (User $user) {
            return in_array($user->role, ['server', 'waiter', 'handyman', 'manager']);
        });

        // 桌面狀態
        Gate::define('table_status_page', function (User $user) {
            return true;
        });

        // 訂單狀態
        Gate::define('order_status_page', function (User $user) {
            return true;
        });

        // 送餐狀態
        Gate::define('delivery_status_page', function (User $user) {
            return true;
        });

        // 員工檔案
        Gate::define('worker_profile_page', function (User $user) {
            // return in_array($user->role, ['server', 'manager']);
            return true;
        });

        // 庫存狀態
        Gate::define('storage_page', function (User $user) {
            // return in_array($user->role, ['manager']);
            return true;
        });
    }
}