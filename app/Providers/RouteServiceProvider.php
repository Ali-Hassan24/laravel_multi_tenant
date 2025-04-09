<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {
        // Define rate limits
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip()
            );
        });

        $centralDomains = $this->centralDomains();

        $this->routes(function () use ($centralDomains) {
            foreach ($centralDomains as $domain) {
                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));

                Route::prefix('api')
                    ->middleware('api')
                    ->domain($domain)
                    ->group(base_path('routes/api.php'));
            }
        });
    }

    protected function centralDomains(): array
    {
        return config('central.domains');
    }
}
