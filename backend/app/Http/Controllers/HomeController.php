<?php

namespace App\Http\Controllers;

use App\Http\Response;

class HomeController
{
    public function index(Response $response)
    {
        return $response->json([
            'success' => true,
            'message' => 'Welcome to Travel ERP API Platform!',
            'version' => '1.0.0',
            'status' => 'operational',
            'endpoints' => [
                'home' => '/',
                'login' => '/auth/login',
                'dashboard' => '/dashboard',
                'api_v1' => '/api/v1'
            ]
        ]);
    }
}
