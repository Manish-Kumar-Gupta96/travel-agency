<?php

declare(strict_types=1);


use App\Controllers\Api\DestinationApiController;
use App\Controllers\Api\PackageApiController;
use App\Controllers\Api\BookingApiController;
use App\Controllers\Api\ContactApiController;
use App\Controllers\Api\UserApiController;



$router->get(

    '/api/destinations',

    [
        DestinationApiController::class,
        'index'
    ]

);



$router->get(

    '/api/packages',

    [
        PackageApiController::class,
        'index'
    ]

);



$router->post(

    '/api/bookings',

    [
        BookingApiController::class,
        'store'
    ]

);



$router->post(

    '/api/contact',

    [
        ContactApiController::class,
        'store'
    ]

);



$router->get(

    '/api/user/profile',

    [
        UserApiController::class,
        'profile'
    ]

);
