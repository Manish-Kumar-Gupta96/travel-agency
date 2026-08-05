<?php

namespace App\Services;

use App\Models\Coupon;
use Exception;

class CouponService
{
    protected Coupon $couponModel;

    public function __construct(
        Coupon $couponModel
    ) {
        $this->couponModel = $couponModel;
    }


    /**
     * Get All Coupons
     */
    public function all(): array
    {
        return $this->couponModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Coupon
     */
    public function find(
        int $id
    ): array
    {
        $coupon = $this->couponModel->find($id);

        if (!$coupon) {
            throw new Exception(
                'Coupon not found.'
            );
        }

        return $coupon;
    }


    /**
     * Find Coupon By Code
     */
    public function findByCode(
        string $code
    ): ?array
    {
        if (
            empty($code)
        ) {
            throw new Exception(
                "Coupon code required"
            );
        }

        return $this->couponModel
            ->where('code', $code)
            ->first();
    }


    /**
     * Create Coupon
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['code'])
        ) {
            throw new Exception(
                "Coupon code required"
            );
        }

        if (
            !isset($data['discount']) ||
            $data['discount'] <= 0
        ) {
            throw new Exception(
                "Invalid discount value"
            );
        }

        $exists = $this->couponModel
            ->where('code', $data['code'])
            ->first();

        if ($exists) {
            throw new Exception(
                "Coupon already exists"
            );
        }

        $status = $data['status'] ?? 1;

        $id = $this->couponModel->create([
            'code'           => $data['code'],
            'type'           => $data['type'] ?? 'percentage',
            'discount'       => $data['discount'],
            'minimum_amount' => $data['minimum_amount'] ?? 0,
            'expiry_date'    => $data['expiry_date'] ?? null,
            'usage_limit'    => $data['usage_limit'] ?? null,
            'used_count'     => $data['used_count'] ?? 0,
            'status'         => $status,
        ]);

        return $this->find($id);
    }


    /**
     * Update Coupon
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $coupon = $this->find($id);

        $payload = [
            'code'           => $data['code'] ?? $coupon['code'],
            'type'           => $data['type'] ?? $coupon['type'],
            'discount'       => $data['discount'] ?? $coupon['discount'],
            'minimum_amount' => $data['minimum_amount'] ?? $coupon['minimum_amount'],
            'expiry_date'    => $data['expiry_date'] ?? $coupon['expiry_date'],
            'usage_limit'    => $data['usage_limit'] ?? $coupon['usage_limit'],
            'used_count'     => $data['used_count'] ?? $coupon['used_count'],
            'status'         => $data['status'] ?? $coupon['status'],
        ];

        $this->couponModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Coupon
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->couponModel->delete($id);
    }


    /**
     * Validate Coupon
     */
    public function validate(
        string $code,
        float $amount
    ): array
    {
        $coupon = $this->findByCode($code);

        if (
            !$coupon
        ) {
            throw new Exception(
                "Invalid coupon"
            );
        }

        if (
            $coupon['status'] != 1
        ) {
            throw new Exception(
                "Coupon inactive"
            );
        }

        if (
            !empty($coupon['expiry_date']) &&
            strtotime($coupon['expiry_date']) < time()
        ) {
            throw new Exception(
                "Coupon expired"
            );
        }

        if (
            $coupon['minimum_amount'] > $amount
        ) {
            throw new Exception(
                "Minimum order amount not reached"
            );
        }

        if (
            $coupon['usage_limit'] !== null &&
            $coupon['used_count'] >= $coupon['usage_limit']
        ) {
            throw new Exception(
                "Coupon usage limit reached"
            );
        }

        $discount = 0;

        if (
            $coupon['type'] == 'percentage'
        ) {
            $discount = ($amount * $coupon['discount']) / 100;
        } else {
            $discount = $coupon['discount'];
        }

        return [
            'coupon'       => $coupon,
            'discount'     => $discount,
            'final_amount' => $amount - $discount
        ];
    }


    /**
     * Apply Coupon Usage
     */
    public function apply(
        int $couponId
    ): bool
    {
        $coupon = $this->find($couponId);

        return $this->couponModel->update($couponId, [
            'used_count' => $coupon['used_count'] + 1
        ]);
    }


    /**
     * Active Coupons
     */
    public function active(): array
    {
        return $this->couponModel
            ->where('status', 1)
            ->get();
    }


    /**
     * Expired Coupons
     */
    public function expired(): array
    {
        return $this->couponModel
            ->where('expiry_date', '<', date('Y-m-d H:i:s'))
            ->get();
    }


    /**
     * Statistics
     */
    public function statistics(): array
    {
        return [
            'total_coupons' => $this->couponModel->count()
        ];
    }
}
