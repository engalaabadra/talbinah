<?php

namespace Modules\Appointment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Appointment\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAdminRoutes();

        $this->mapDoctorRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Appointment', '/Routes/web.php'));
    }


    
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapapiRoutes()
    {
        Route::prefix('api/appointments')
            ->middleware(['auth:api','role:user'])
            ->as('api.appointments.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Appointment', '/Routes/api.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware(['auth:api','role:superadmin|admin'])
            ->as('api.admin.appointments.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Appointment', '/Routes/admin.php'));
    }
    /**
     * Define the "doctor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDoctorRoutes()
    {
        Route::prefix('api/doctor')
            ->middleware(['auth:api','role:doctor'])
            ->as('api.doctor.appointments.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Appointment', '/Routes/doctor.php'));
    }
}
