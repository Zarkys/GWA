<?php

namespace Modules\Sliders\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Sliders\Http\Controllers';

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

    public function map()
    {
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->moduleNamespace,
            'prefix' => 'goadmin',
        ], function ($router) {
            self::get_routes(__DIR__ . '/../Routes/');
        });

    }

    public function get_routes($dir)
    {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (!is_dir($dir . $file) && $file != "." && $file != "..") {
                    require $dir . $file;
                } elseif ($file != "." && $file != "..") {
                    self::get_routes($dir . $file . '/');
                }
            }
            closedir($dh);
        }
    }
}
