<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\View;
use App\Models\Profile;
use App\Models\User;

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
        Paginator::useBootstrap();
        Password::defaults(function () {
            return Password::min(8)
                            ->mixedCase()
                            ->letters()
                            ->numbers()
                            ->symbols();
        });

        View::composer('layouts.topbar-sidebar', function ($view) {
            $user_id = auth()->user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
    
            if (!$profile) {
                $profile = collect();
            }
    
            $view->with('profile', $profile);
        });
    }
}
