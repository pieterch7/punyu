<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot(Router $router)
    {
        //model binding
        parent::boot($router);
        $router->model('siswa', 'App\Siswa');
        $router->model('kelas', 'App\Kelas');
        $router->model('hobi', 'App\Hobi');
    }

    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace],
            function ($router){
                require app_path('Http/routes.php');
            });
    }

    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
