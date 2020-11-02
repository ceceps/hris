<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Interfaces\DepartementInterface',
            'App\Repositories\DepartementRepository'
        );

        $this->app->bind(
            'App\Interfaces\EmployeeInterface',
            'App\Repositories\EmployeeRepository'
        );

        $this->app->bind(
            'App\Interfaces\KeluargaInterface',
            'App\Repositories\KeluargaRepository'
        );

        $this->app->bind(
            'App\Interfaces\JobInterface',
            'App\Repositories\JobRepository'
        );

        $this->app->bind(
            'App\Interfaces\JobLevelInterface',
            'App\Repositories\JobLevelRepository'
        );

        $this->app->bind(
            'App\Interfaces\CategoryInterface',
            'App\Repositories\CategoryRepository'
        );

        $this->app->bind(
            'App\Interfaces\AttendanceInterface',
            'App\Repositories\AttendanceRepository'
        );

        $this->app->bind(
            'App\Interfaces\WorkplanInterface',
            'App\Repositories\WorkplanRepository'
        );

        $this->app->bind(
            'App\Interfaces\PayrollInterface',
            'App\Repositories\PayrollRepository'
        );
    }
}
