<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Pagination\Paginator;


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
    public function boot() 
    {
        View::composer("layouts.navbar", function ($view) {
            $listCategories = Category::all();
            $view->with("categories", $listCategories);
        });

        Gate::define('admin', function(User $user) {
            return $user->is_admin;
        }); 
    }
}
