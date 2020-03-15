<?php

namespace App\Providers;

use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;
use Ajiwai\Infrastracture\Repositories\Auth\AuthUserRepository;
use Ajiwai\Library\Auth\AjiwaiJWTGuard;
use Ajiwai\Library\Auth\FirebaseUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTGuard;

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

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('firebase', function () {
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
