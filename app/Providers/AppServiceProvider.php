<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use \Illuminate\Http\Response;
use \App\Exceptions\RateLimitedException;

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
        // @todo review
        /*
        use Illuminate\Auth\Notifications\ResetPassword;
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
        */

        RateLimiter::for(
            'api',
            function (Request $request) {
                return Limit::perMinute(
                        $request->user()?->getRateLimit() ??
                            config('app.unauthenticated_user_rate_limit', null), // @todo review value
                     )
                    ->by('minute:' . $request->user()?->id ?: $request->ip())
                    ->response(function (Request $request, array $headers) {
                        throw new RateLimitedException();
                    });
            }
        );
    }
}
