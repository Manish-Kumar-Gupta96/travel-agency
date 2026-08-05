<?php

namespace App\Services;

use App\Models\User;
use App\Core\Security\Hash;
use Exception;

class UserService
{
    protected User $userModel;

    public function __construct(
        User $userModel
    ) {
        $this->userModel = $userModel;
    }


    /**
     * Get All Users
     */
    public function all(): array
    {
        return $this->userModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find User
     */
    public function find(
        int $id
    ): array
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new Exception('User not found.');
        }

        return $user;
    }


    /**
     * Create User
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['password'])
        ) {
            throw new Exception('Required fields are missing.');
        }

        $exists = $this->userModel
            ->where('email', $data['email'])
            ->first();

        if ($exists) {
            throw new Exception('Email already exists.');
        }

        $id = $this->userModel->create([

            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'phone'     => $data['phone'] ?? '',
            'role'      => $data['role'] ?? 'customer',
            'status'    => $data['status'] ?? 'active',

        ]);

        return $this->find($id);
    }


    /**
     * Update User
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $user = $this->find($id);

        $payload = [

            'name'   => $data['name'] ?? $user['name'],
            'email'  => $data['email'] ?? $user['email'],
            'phone'  => $data['phone'] ?? $user['phone'],
            'role'   => $data['role'] ?? $user['role'],
            'status' => $data['status'] ?? $user['status'],

        ];

        if (!empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $this->userModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete User
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->userModel->delete($id);
    }


    /**
     * Search Users
     */
    public function search(
        string $keyword
    ): array
    {
        return $this->userModel
            ->groupStart()
                ->like('name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Update Status
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool
    {
        $this->find($id);

        return $this->userModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }


    /**
     * Get Active Users
     */
    public function active(): array
    {
        return $this->userModel
            ->where('status', 'active')
            ->get();
    }


    /**
     * User Statistics
     */
    public function statistics(): array
    {
        return [

            'total' => $this->userModel->count(),

            'active' => $this->userModel
                ->where('status', 'active')
                ->count(),

            'inactive' => $this->userModel
                ->where('status', 'inactive')
                ->count(),

            'admins' => $this->userModel
                ->where('role', 'admin')
                ->count(),

            'customers' => $this->userModel
                ->where('role', 'customer')
                ->count(),

            'staff' => $this->userModel
                ->where('role', 'staff')
                ->count(),

        ];
    }
}
