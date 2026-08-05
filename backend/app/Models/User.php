<?php

namespace App\Models;

use App\Core\Database\Model;


class User extends Model
{

    protected static string $table = 'users';


    protected array $fillable = [

        'name',

        'email',

        'password',

        'phone',

        'role',

        'status',

    ];



    /**
     * Get User By Email
     */
    public function findByEmail(
        string $email
    ): ?array
    {

        return $this
            ->where(
                'email',
                $email
            )
            ->first();

    }



    /**
     * Get Active Users
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                'active'
            )
            ->get();

    }



    /**
     * Get Users By Role
     */
    public function byRole(
        string $role
    ): array
    {

        return $this
            ->where(
                'role',
                $role
            )
            ->get();

    }



    /**
     * Check Email Exists
     */
    public function emailExists(
        string $email
    ): bool
    {

        return $this
            ->where(
                'email',
                $email
            )
            ->exists();

    }



    /**
     * Update Password
     */
    public function updatePassword(
        int $id,
        string $password
    ): bool
    {

        return $this->update(
            $id,
            [

                'password' => $password

            ]
        );

    }



    /**
     * Disable User
     */
    public function disable(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'status' => 'inactive'

            ]
        );

    }



    /**
     * Enable User
     */
    public function enable(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'status' => 'active'

            ]
        );

    }



    /**
     * User Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->count(),


            'active' =>
                $this
                ->where(
                    'status',
                    'active'
                )
                ->count(),


            'inactive' =>
                $this
                ->where(
                    'status',
                    'inactive'
                )
                ->count(),


            'admins' =>
                $this
                ->where(
                    'role',
                    'admin'
                )
                ->count(),


        ];

    }


}
