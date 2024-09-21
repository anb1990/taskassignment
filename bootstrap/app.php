<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
                ->withRouting(
                        web: __DIR__ . '/../routes/web.php',
                        api: __DIR__ . '/../routes/api.php',
                        commands: __DIR__ . '/../routes/console.php',
                        health: '/up',
                )
                ->withMiddleware(function (Middleware $middleware) {
                    $middleware->alias([
                        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'auth.redirect' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'auth.nredirect' => \App\Http\Middleware\RedirectIfNotAuthenticated::class,
                    ]);

                    $middleware->append([
                        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
                        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
                    ]);

                    $middleware->appendToGroup('web',
                            [
                                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                                \Illuminate\Session\Middleware\StartSession::class,
                                \Illuminate\Session\Middleware\AuthenticateSession::class,
                                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                    ]);
                    $middleware->appendToGroup('api',
                            [
                                //\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
                                \Laravel\Passport\Http\Middleware\CheckClientCredentials::class,
                                //'throttle:api',
                                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                    ]);

                    
                })
                ->withExceptions(function (Exceptions $exceptions) {
                    //
                })->create();
