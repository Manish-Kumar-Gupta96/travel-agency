<?php

namespace App\Services;

use App\Models\User;
use App\Core\Security\Hash;
use App\Core\Security\JWT;
use Exception;


class AuthService
{

    protected User $userModel;


    public function __construct(
        User $userModel
    ) {

        $this->userModel = $userModel;

    }



    /**
     * User Login
     */
    public function login(
        array $credentials
    ): array {


        $email = $credentials['email'] ?? null;
        $password = $credentials['password'] ?? null;


        if (!$email || !$password) {

            throw new Exception(
                'Email and password are required.'
            );

        }



        $user = $this->userModel->where(
            'email',
            $email
        )->first();



        if (!$user) {

            throw new Exception(
                'Invalid email or password.'
            );

        }



        if (!Hash::verify(
            $password,
            $user['password']
        )) {

            throw new Exception(
                'Invalid email or password.'
            );

        }



        $token = JWT::generate([
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'user',
        ]);



        return [

            'user' => [

                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'] ?? 'user',

            ],

            'token' => $token,

        ];

    }




    /**
     * User Registration
     */
    public function register(
        array $data
    ): array {


        if (
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['password'])
        ) {

            throw new Exception(
                'Required fields are missing.'
            );

        }



        $exists = $this->userModel
            ->where(
                'email',
                $data['email']
            )
            ->first();



        if ($exists) {

            throw new Exception(
                'Email already registered.'
            );

        }



        $userId = $this->userModel->create([

            'name' => $data['name'],

            'email' => $data['email'],

            'password' => Hash::make(
                $data['password']
            ),

            'role' => $data['role'] ?? 'customer',

            'status' => 'active',

        ]);



        return [

            'id' => $userId,

            'name' => $data['name'],

            'email' => $data['email'],

        ];

    }




    /**
     * Logout User
     */
    public function logout(
        string $token
    ): bool {


        if (!$token) {

            throw new Exception(
                'Token required.'
            );

        }



        JWT::invalidate($token);


        return true;

    }




    /**
     * Get Current User
     */
    public function user(
        int $id
    ): array {


        $user = $this->userModel->find($id);



        if (!$user) {

            throw new Exception(
                'User not found.'
            );

        }



        return [

            'id' => $user['id'],

            'name' => $user['name'],

            'email' => $user['email'],

            'role' => $user['role'],

            'status' => $user['status'],

        ];

    }




    /**
     * Change Password
     */
    public function changePassword(
        int $id,
        array $data
    ): bool {


        $user = $this->userModel->find($id);



        if (!$user) {

            throw new Exception(
                'User not found.'
            );

        }



        if (
            !Hash::verify(
                $data['old_password'],
                $user['password']
            )
        ) {

            throw new Exception(
                'Old password does not match.'
            );

        }



        $this->userModel->update(
            $id,
            [

                'password' => Hash::make(
                    $data['password']
                )

            ]
        );


        return true;

    }




    /**
     * Reset Password
     */
    public function resetPassword(
        string $email
    ): bool {


        $user = $this->userModel
            ->where(
                'email',
                $email
            )
            ->first();



        if (!$user) {

            throw new Exception(
                'Email not found.'
            );

        }



        /*
            Password reset mail
            integration will be added
            using SMTP service
        */



        return true;

    }



    /**
     * Verify Token
     */
    public function verifyToken(
        string $token
    ): array {


        return JWT::verify($token);

    }


}
