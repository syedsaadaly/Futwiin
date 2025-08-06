<?php

namespace App\Providers;

use App\Repositories\LeagueRepository;
use App\Repositories\LeagueRepositoryEloquent;
use App\Repositories\PaymentRepository;
use App\Repositories\PaymentRepositoryInterface;
use App\Repositories\PlanRepository;
use App\Repositories\PlanRepositoryEloquent;
use App\Repositories\PridectionRepository;
use App\Repositories\PridectionRepositoryEloquent;
use App\Repositories\TeamRepository;
use App\Repositories\TeamRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );

        $this->app->bind(
            LeagueRepository::class,
            LeagueRepositoryEloquent::class
        );
        $this->app->bind(
            PlanRepository::class,
            PlanRepositoryEloquent::class
        );
        $this->app->bind(
            TeamRepository::class,
            TeamRepositoryEloquent::class
        );
        $this->app->bind(
            PridectionRepository::class,
            PridectionRepositoryEloquent::class
        );
        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class
        );
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
