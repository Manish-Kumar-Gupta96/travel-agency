<?php

use App\Controllers\AdminController;
use App\Controllers\ContactController;
use App\Middleware\AuthMiddleware;

$auth = new AuthMiddleware();

$router->get(
    '/admin/dashboard',
    [AdminController::class, 'dashboard']
)
->middleware($auth);

$router->get(
    '/contact',
    [ContactController::class, 'index']
);

$router->post(
    '/contact/send',
    [ContactController::class, 'send']
);
