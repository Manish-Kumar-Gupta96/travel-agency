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
            | Model and CRM APIs
            |--------------------------------------------------------------------------
            */

            // Customers
            $router->get('/customers', ['App\Controllers\CustomerController', 'index']);
            $router->get('/customers/statistics', ['App\Controllers\CustomerController', 'statistics']);
            $router->get('/customers/{id}', ['App\Controllers\CustomerController', 'show']);
            $router->post('/customers', ['App\Controllers\CustomerController', 'store']);
            $router->put('/customers/{id}', ['App\Controllers\CustomerController', 'update']);
            $router->delete('/customers/{id}', ['App\Controllers\CustomerController', 'destroy']);
            $router->get('/customers/{id}/bookings', ['App\Controllers\CustomerController', 'bookings']);

            // Tour Packages
            $router->get('/packages', ['App\Controllers\TourPackageController', 'index']);
            $router->get('/packages/{id}', ['App\Controllers\TourPackageController', 'show']);
            $router->post('/packages', ['App\Controllers\TourPackageController', 'store']);
            $router->put('/packages/{id}', ['App\Controllers\TourPackageController', 'update']);
            $router->delete('/packages/{id}', ['App\Controllers\TourPackageController', 'destroy']);

            // Bookings
            $router->get('/bookings', ['App\Controllers\BookingController', 'index']);
            $router->get('/bookings/statistics', ['App\Controllers\BookingController', 'statistics']);
            $router->get('/bookings/{id}', ['App\Controllers\BookingController', 'show']);
            $router->post('/bookings', ['App\Controllers\BookingController', 'store']);
            $router->put('/bookings/{id}', ['App\Controllers\BookingController', 'update']);
            $router->delete('/bookings/{id}', ['App\Controllers\BookingController', 'destroy']);

            // Payments
            $router->get('/payments', ['App\Controllers\PaymentController', 'index']);
            $router->get('/payments/statistics', ['App\Controllers\PaymentController', 'statistics']);
            $router->get('/payments/{id}', ['App\Controllers\PaymentController', 'show']);
            $router->post('/payments', ['App\Controllers\PaymentController', 'store']);

            // Destinations
            $router->get('/destinations', ['App\Controllers\DestinationController', 'index']);
            $router->get('/destinations/{id}', ['App\Controllers\DestinationController', 'show']);
            $router->post('/destinations', ['App\Controllers\DestinationController', 'store']);
            $router->put('/destinations/{id}', ['App\Controllers\DestinationController', 'update']);
            $router->delete('/destinations/{id}', ['App\Controllers\DestinationController', 'destroy']);

            // Albums
            $router->get('/albums', ['App\Controllers\AlbumController', 'index']);
            $router->get('/albums/{id}', ['App\Controllers\AlbumController', 'show']);
            $router->post('/albums', ['App\Controllers\AlbumController', 'store']);

            // Gallery
            $router->get('/gallery', ['App\Controllers\GalleryController', 'index']);
            $router->get('/gallery/{id}', ['App\Controllers\GalleryController', 'show']);
            $router->post('/gallery', ['App\Controllers\GalleryController', 'store']);

            // Coupons
            $router->get('/coupons', ['App\Controllers\CouponController', 'index']);
            $router->get('/coupons/{id}', ['App\Controllers\CouponController', 'show']);
            $router->post('/coupons', ['App\Controllers\CouponController', 'store']);

            // Reviews
            $router->get('/reviews', ['App\Controllers\ReviewController', 'index']);
            $router->get('/reviews/{id}', ['App\Controllers\ReviewController', 'show']);
            $router->post('/reviews', ['App\Controllers\ReviewController', 'store']);

            // Visas
            $router->get('/visas', ['App\Controllers\VisaController', 'index']);
            $router->get('/visas/{id}', ['App\Controllers\VisaController', 'show']);
            $router->post('/visas', ['App\Controllers\VisaController', 'store']);

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
