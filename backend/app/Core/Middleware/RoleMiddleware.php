<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Security\Auth;

class RoleMiddleware
{
    public function handle(Request $request, callable $next, string ...$roles): mixed
    {
        if (!Auth::check()) {
            return (new Response())->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();
        $userRole = $user['role'] ?? '';

        if (!in_array($userRole, $roles, true)) {
            return (new Response())->json([
                'success' => false,
                'message' => 'Forbidden: Insufficient role privileges'
            ], 403);
        }

        return $next($request);
    }
}
