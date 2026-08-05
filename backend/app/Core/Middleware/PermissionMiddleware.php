<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Security\Auth;
use App\Core\Security\Permission;

class PermissionMiddleware
{
    public function handle(Request $request, callable $next, string $permission): mixed
    {
        if (!Auth::check()) {
            return (new Response())->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = Auth::user();

        if (!Permission::check($user, $permission)) {
            return (new Response())->json([
                'success' => false,
                'message' => 'Forbidden: Missing permission ' . $permission
            ], 403);
        }

        return $next($request);
    }
}
