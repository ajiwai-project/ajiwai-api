<?php

namespace App\Providers;

use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;
use Ajiwai\Infrastracture\Repositories\Auth\AuthUserRepository;
use Ajiwai\Library\Auth\AuthUserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthUserRepositoryInterface::class, function () {
            return new AuthUserRepository(new UserFBDao());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
