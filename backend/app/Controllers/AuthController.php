<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class AuthController
{
    protected AuthService $authService;

    public function __construct(
        AuthService $authService
    ) {
        $this->authService = $authService;
    }

    /**
     * User Login
     */
    public function login(
        Request $request,
        Response $response
    ) {
        try {
            $credentials = $request->all();
            $result = $this->authService->login($credentials);

            return $response->json([
                'success' => true,
                'message' => 'Login successful.',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * User Registration
     */
    public function register(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $result = $this->authService->register($data);

            return $response->json([
                'success' => true,
                'message' => 'Registration successful.',
                'data' => $result,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Logout User
     */
    public function logout(
        Request $request,
        Response $response
    ) {
        try {
            $token = $request->bearerToken() ?? $request->input('token') ?? '';
            $this->authService->logout($token);

            return $response->json([
                'success' => true,
                'message' => 'Logout successful.',
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Change Password
     */
    public function changePassword(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $result = $this->authService->changePassword($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Password changed successfully.',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Reset Password
     */
    public function resetPassword(
        Request $request,
        Response $response
    ) {
        try {
            $email = $request->input('email') ?? '';
            $result = $this->authService->resetPassword($email);

            return $response->json([
                'success' => true,
                'message' => 'Password reset instructions sent.',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get Current User
     */
    public function user(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $user = $this->authService->user($id);

            return $response->json([
                'success' => true,
                'data' => $user,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
