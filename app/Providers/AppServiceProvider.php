<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Share pendingCount with the navigation view
        View::composer('layouts.navigation', function ($view) {
            if (auth()->check() && auth()->user()->role === 'admin') {
                $pendingCount = User::where('role', 'staff')
                                    ->where('status', 'pending')
                                    ->count();
            } else {
                $pendingCount = 0;
            }
            $view->with('pendingCount', $pendingCount);

            return view('dashboard');
        });
    }
}
