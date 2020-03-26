<?php

namespace App\Providers;

use Ajiwai\Application\Requests\Auth\RefreshTokenRequest;
use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;
use Ajiwai\Infrastracture\Repositories\Auth\AuthUserRepository;
use Ajiwai\Library\Auth\AjiwaiJWTGuard;
use Ajiwai\Library\Auth\AjiwaiRefreshTokenGuard;
use Ajiwai\Library\Auth\FirebaseUserProvider;
use Ajiwai\Library\Auth\RefreshToken;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register()
    {
        $this->app->bind(
            AjiwaiRefreshTokenGuard::class,
            function () {
                return new AjiwaiRefreshTokenGuard(
                    new RefreshToken($this->app->make('tymon.jwt')),
                    new AuthUserRepository(new UserFBDao()),
                    new UserFBDao(),
                    new RefreshTokenRequest()
                );
            }
        );
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        AUth::provider('firebase', function () {
            return new FirebaseUserProvider(new AuthUserRepository(new UserFBDao()));
        });

        AUth::extend('jwt', function ($app, $name, array $config) {
            return new AjiwaiJWTGuard(
                $app['tymon.jwt'],
                $app['auth']->createUserProvider($config['provider']),
                $app['request']
            );
        });
    }
}
