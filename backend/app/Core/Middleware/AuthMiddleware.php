<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Security\Auth;
use App\Core\Security\JWT;
use Exception;

class AuthMiddleware
{
    public function handle(Request $request, callable $next): mixed
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
            try {
                $decoded = JWT::decode($token);
                Auth::setUser((array) $decoded);
                return $next($request);
            } catch (Exception $e) {
                return (new Response())->json([
                    'success' => false,
                    'message' => 'Unauthorized: Invalid token'
                ], 401);
            }
        }

        return (new Response())->json([
            'success' => false,
            'message' => 'Unauthorized: Token missing'
        ], 401);
    }
}
