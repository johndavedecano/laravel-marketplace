<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('api.exception')->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->make(
                ['error' => 'Resource not found', 'status' => 404],
                404
            );
        });

        app('api.exception')->register(function (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->make(
                ['error' => $e->getMessage(), 'status' => 401],
                401
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
