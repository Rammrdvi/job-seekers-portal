<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Cache\Limit;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            require base_path('routes/web.php');

            // Check if the api.php file exists before requiring it
            $apiRoutesFile = base_path('routes/api.php');
            if (file_exists($apiRoutesFile)) {
                require $apiRoutesFile;
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        FacadesRateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
