<?php

namespace Modules\Payment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Payment\Http\Controllers';

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
        $this->mapAdminRoutes();

        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapDoctorRoutes();

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
            ->group(module_path('Payment', '/Routes/web.php'));
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
        Route::prefix('api/admin')
            ->middleware(['auth:api','role:superadmin|admin'])
            ->namespace($this->moduleNamespace)
            ->group(module_path('Payment', '/Routes/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Payment', '/Routes/api.php'));
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
           ->as('api.doctor.Payments.')
           ->middleware(['auth:api','role:doctor'])
          ->namespace($this->moduleNamespace)
           ->group(module_path('Payment', '/Routes/doctor.php'));
   }
}
