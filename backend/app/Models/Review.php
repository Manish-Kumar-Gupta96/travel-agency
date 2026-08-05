<?php

namespace App\Models;

use App\Core\Database\Model;


class Review extends Model
{

    protected static string $table = 'reviews';


    protected array $fillable = [

        'customer_id',

        'package_id',

        'rating',

        'comment',

        'status',

        'featured',

    ];





    /**
     * Approve Review
     */
    public function approve(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'status' => 'approved'

            ]
        );

    }





    /**
     * Reject Review
     */
    public function reject(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'status' => 'rejected'

            ]
        );

    }





    /**
     * Package Wise Reviews
     */
    public function byPackage(
        int $packageId
    ): array
    {

        return $this
            ->where(
                'package_id',
                $packageId
            )
            ->where(
                'status',
                'approved'
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

    }





    /**
     * Customer Wise Reviews
     */
    public function byCustomer(
        int $customerId
    ): array
    {

        return $this
            ->where(
                'customer_id',
                $customerId
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

    }





    /**
     * Featured Reviews
     */
    public function featured(): array
    {

        return $this
            ->where(
                'featured',
                1
            )
            ->where(
                'status',
                'approved'
            )
            ->get();

    }





    /**
     * Pending Reviews
     */
    public function pending(): array
    {

        return $this
            ->where(
                'status',
                'pending'
            )
            ->get();

    }





    /**
     * Review Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->count(),


            'approved' =>
                $this
                ->where(
                    'status',
                    'approved'
                )
                ->count(),


            'pending' =>
                $this
                ->where(
                    'status',
                    'pending'
                )
                ->count(),


            'rejected' =>
                $this
                ->where(
                    'status',
                    'rejected'
                )
                ->count(),

        ];

    }


}
