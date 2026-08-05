<?php

declare(strict_types=1);

use App\Routing\Router;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| All REST API endpoints are registered here.
| API routes use JSON responses and API middleware.
|
*/


return static function (Router $router): void {


    /*
    |--------------------------------------------------------------------------
    | API Version 1
    |--------------------------------------------------------------------------
    */


    $router->group(

        [

            'prefix'=>'api/v1',

            'middleware'=>[

                'api',

                'throttle'

            ]

        ],

        function(Router $router){



            /*
            |--------------------------------------------------------------------------
            | Public Authentication APIs
            |--------------------------------------------------------------------------
            */


            $router->post(

                '/auth/register',

                [

                    'App\Http\Controllers\Api\AuthController',

                    'register'

                ]

            );



            $router->post(

                '/auth/login',

                [

                    'App\Http\Controllers\Api\AuthController',

                    'login'

                ]

            );



            $router->post(

                '/auth/forgot-password',

                [

                    'App\Http\Controllers\Api\AuthController',

                    'forgotPassword'

                ]

            );



            $router->post(

                '/auth/reset-password',

                [

                    'App\Http\Controllers\Api\AuthController',

                    'resetPassword'

                ]

            );





            /*
            |--------------------------------------------------------------------------
            | Protected Routes
            |--------------------------------------------------------------------------
            */


            $router->group(

                [

                    'middleware'=>[

                        'auth:api'

                    ]

                ],

                function(Router $router){



                    /*
                    |--------------------------------------------------------------------------
                    | User Profile
                    |--------------------------------------------------------------------------
                    */


                    $router->get(

                        '/user',

                        [

                            'App\Http\Controllers\Api\UserController',

                            'profile'

                        ]

                    );



                    $router->put(

                        '/user',

                        [

                            'App\Http\Controllers\Api\UserController',

                            'update'

                        ]

                    );



                    /*
                    |--------------------------------------------------------------------------
                    | Logout
                    |--------------------------------------------------------------------------
                    */


                    $router->post(

                        '/auth/logout',

                        [

                            'App\Http\Controllers\Api\AuthController',

                            'logout'

                        ]

                    );



                }

            );



        }

    );


};
