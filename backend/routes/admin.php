<?php

declare(strict_types=1);

use App\Routing\Router;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All admin panel routes are registered here.
| Protected by authentication and RBAC middleware.
|
*/


return static function (Router $router): void {


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Prefix
    |--------------------------------------------------------------------------
    */


    $router->group(

        [

            'prefix'=>'admin',

            'middleware'=>[

                'auth',

                'role:admin'

            ]

        ],

        function(Router $router){



            /*
            |--------------------------------------------------------------------------
            | Admin Dashboard
            |--------------------------------------------------------------------------
            */


            $router->get(

                '/',

                [

                    'App\Http\Controllers\Admin\DashboardController',

                    'index'

                ]

            );



            /*
            |--------------------------------------------------------------------------
            | User Management
            |--------------------------------------------------------------------------
            */


            $router->group(

                [

                    'prefix'=>'users',

                    'middleware'=>[

                        'permission:users.manage'

                    ]

                ],

                function(Router $router){



                    $router->get(

                        '/',

                        [

                            'App\Http\Controllers\Admin\UserController',

                            'index'

                        ]

                    );



                    $router->post(

                        '/',

                        [

                            'App\Http\Controllers\Admin\UserController',

                            'store'

                        ]

                    );



                    $router->put(

                        '/{id}',

                        [

                            'App\Http\Controllers\Admin\UserController',

                            'update'

                        ]

                    );



                    $router->delete(

                        '/{id}',

                        [

                            'App\Http\Controllers\Admin\UserController',

                            'destroy'

                        ]

                    );



                }

            );



        }

    );


};
