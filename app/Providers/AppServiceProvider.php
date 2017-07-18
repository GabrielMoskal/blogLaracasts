<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // it means that when the layouts.sidebar view is loaded,
        // insert into view object named archives, it will be available
        // in every layouts.sidebar
        // we can send classpath instead of a function, so we can do dedicated class
        view()->composer('layouts.sidebar', function($view) {
            $view->with('archives', Post::archives());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    // we bind things to the server's container
    public function register()
    {
        \App::bind(Stripe::class, function (/* optional argument */$app) {
            // $app->make('');
            return new Stripe(config('services.stripe.secret'));
        });

        /*
        \App::singleton('App\Billing\Stripe', function () {
            return new \App\Billing\Stripe(config('services.stripe.secret'));
        });
        */

        /*
        $this->app->singleton('App\Billing\Stripe', function () {
            return new \App\Billing\Stripe(config('services.stripe.secret'));
        });
        */

        // $stripe = App::make('App\Billing\Stripe');

        // instead of App::make there is a helper function
        // $stripe = resolve('App\Billing\Stripe');
        // or another:
        // $stripe = app('App\Billing\Stripe');
    }
}
