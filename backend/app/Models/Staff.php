<?php

namespace App\Models;

use App\Core\Database\Model;


class Staff extends Model
{

    protected static string $table = 'staff';


    protected array $fillable = [

        'name',

        'email',

        'phone',

        'designation',

        'department',

        'salary',

        'joining_date',

        'address',

        'status',

    ];




    /**
     * Find Staff By Email
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
     * Active Staff
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
     * Department Wise Staff
     */
    public function byDepartment(
        string $department
    ): array
    {

        return $this
            ->where(
                'department',
                $department
            )
            ->get();

    }




    /**
     * Search Staff
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'name',
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
                    'designation',
                    $keyword
                )

                ->orLike(
                    'department',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }




    /**
     * Update Staff Profile
     */
    public function updateProfile(
        int $id,
        array $data
    ): bool
    {

        return $this->update(
            $id,
            [

                'name' =>
                    $data['name'] ?? null,

                'phone' =>
                    $data['phone'] ?? null,

                'address' =>
                    $data['address'] ?? null,

                'designation' =>
                    $data['designation'] ?? null,

                'department' =>
                    $data['department'] ?? null,

            ]
        );

    }




    /**
     * Disable Staff
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
     * Enable Staff
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
     * Staff Statistics
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


            'departments' =>
                $this
                ->distinct('department')
                ->count(),


        ];

    }


}
