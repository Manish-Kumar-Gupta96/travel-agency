<?php

namespace App\Models;

use App\Core\Database\Model;


class Customer extends Model
{

    protected static string $table = 'customers';


    protected array $fillable = [

        'first_name',

        'last_name',

        'email',

        'phone',

        'gender',

        'dob',

        'passport',

        'nationality',

        'address',

        'city',

        'country',

        'status',

    ];




    /**
     * Get Customer By Email
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
     * Get Active Customers
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
     * Search Customer
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'first_name',
                    $keyword
                )

                ->orLike(
                    'last_name',
                    $keyword
                )

                ->orLike(
                    'email',
                    $keyword
                )

                ->orLike(
                    'phone',
                    $keyword
                )

                ->orLike(
                    'passport',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }




    /**
     * Update Profile
     */
    public function updateProfile(
        int $id,
        array $data
    ): bool
    {

        return $this->update(
            $id,
            [

                'first_name' =>
                    $data['first_name'] ?? null,

                'last_name' =>
                    $data['last_name'] ?? null,

                'phone' =>
                    $data['phone'] ?? null,

                'address' =>
                    $data['address'] ?? null,

                'city' =>
                    $data['city'] ?? null,

                'country' =>
                    $data['country'] ?? null,

            ]
        );

    }




    /**
     * Verify Passport
     */
    public function verifyPassport(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'passport_verified' => 1

            ]
        );

    }




    /**
     * Customer Statistics
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


            'passport_verified' =>
                $this
                ->where(
                    'passport_verified',
                    1
                )
                ->count(),


        ];

    }



}
