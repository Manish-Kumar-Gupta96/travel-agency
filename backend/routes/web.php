<?php

declare(strict_types=1);

use App\Routing\Router;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Browser based routes are registered here.
| These routes are handled by web middleware group.
|
*/


return static function (Router $router): void {


    /*
    |--------------------------------------------------------------------------
    | Home Route
    |--------------------------------------------------------------------------
    */

    $router->get(

        '/',

        [

            'App\Http\Controllers\HomeController',

            'index'

        ]

    );



    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */


    $router->group(

        [

            'prefix'=>'auth',

            'middleware'=>[

                'web'

            ]

        ],

        function(Router $router){



            $router->get(

                '/login',

                [

                    'App\Http\Controllers\AuthController',

                    'login'

                ]

            );



            $router->post(

                '/login',

                [

                    'App\Http\Controllers\AuthController',

                    'authenticate'

                ]

            );



            $router->post(

                '/logout',

                [

                    'App\Http\Controllers\AuthController',

                    'logout'

                ]

            );



        }

    );



    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */


    $router->group(

        [

            'prefix'=>'dashboard',

            'middleware'=>[

                'auth'

            ]

        ],

        function(Router $router){



            $router->get(

                '/',

                [

                    'App\Http\Controllers\DashboardController',

                    'index'

                ]

            );


        }

    );


};
