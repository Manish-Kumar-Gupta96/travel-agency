<?php

namespace App\Models;

use App\Core\Database\Model;


class Coupon extends Model
{

    protected static string $table = 'coupons';


    protected array $fillable = [

        'code',

        'type',

        'discount',

        'minimum_amount',

        'expiry_date',

        'usage_limit',

        'used_count',

        'status',

    ];





    /**
     * Find Coupon By Code
     */
    public function findByCode(
        string $code
    ): ?array
    {

        return $this
            ->where(
                'code',
                $code
            )
            ->first();

    }





    /**
     * Get Active Coupons
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                1
            )
            ->get();

    }





    /**
     * Get Expired Coupons
     */
    public function expired(): array
    {

        return $this
            ->where(
                'expiry_date <',
                date('Y-m-d H:i:s')
            )
            ->get();

    }





    /**
     * Coupon Statistics
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
                    1
                )
                ->count(),


            'inactive' =>
                $this
                ->where(
                    'status',
                    0
                )
                ->count(),

        ];

    }


}
