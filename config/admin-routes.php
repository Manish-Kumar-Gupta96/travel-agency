<?php

declare(strict_types=1);


use App\Controllers\AdminController;
use App\Controllers\AdminBookingController;
use App\Controllers\AdminBookingStatusController;
use App\Controllers\AdminPackageController;
use App\Controllers\AdminDestinationController;
use App\Controllers\AdminUserController;



$router->get(
    '/admin/dashboard',
    [AdminController::class,'dashboard']
);



$router->get(
    '/admin/bookings',
    [AdminBookingController::class,'index']
);



$router->post(
    '/admin/bookings/status',
    [AdminBookingStatusController::class,'update']
);



$router->get(
    '/admin/packages',
    [AdminPackageController::class,'index']
);



$router->post(
    '/admin/packages/store',
    [AdminPackageController::class,'store']
);



$router->get(
    '/admin/destinations',
    [AdminDestinationController::class,'index']
);



$router->post(
    '/admin/destinations/store',
    [AdminDestinationController::class,'store']
);



$router->get(
    '/admin/users',
    [AdminUserController::class,'index']
);



$router->post(
    '/admin/users/role',
    [AdminUserController::class,'updateRole']
);
