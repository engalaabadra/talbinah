<?php

namespace Modules\ArticleCategory\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\ArticleCategory\Http\Controllers';

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
            ->group(module_path('ArticleCategory', '/Routes/web.php'));
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
        Route::prefix('api/')
            ->middleware(['auth:api','role:user'])
            ->as('api.articles-categories.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('ArticleCategory', '/Routes/api.php'));
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
            ->as('api.admin.articles-categories.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('ArticleCategory', '/Routes/admin.php'));
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
            ->as('api.doctor.articles-categories.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('ArticleCategory', '/Routes/doctor.php'));
    }
}
