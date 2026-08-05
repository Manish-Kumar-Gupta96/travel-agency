<?php

namespace App\Controllers;

use App\Services\CouponService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class CouponController
{
    protected CouponService $couponService;

    public function __construct(
        CouponService $couponService
    ) {
        $this->couponService = $couponService;
    }

    /**
     * Get All Coupons
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $coupons = $this->couponService->all();

            return $response->json([
                'success' => true,
                'data' => $coupons,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Coupon Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $coupon = $this->couponService->find($id);

            return $response->json([
                'success' => true,
                'data' => $coupon,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Coupon
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $coupon = $this->couponService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Coupon created successfully.',
                'data' => $coupon,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Coupon
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $coupon = $this->couponService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Coupon updated successfully.',
                'data' => $coupon,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Coupon
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->couponService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Coupon deleted successfully.',
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
     * Validate Coupon
     */
    public function validate(
        Request $request,
        Response $response
    ) {
        try {
            $code = $request->input('code') ?? '';
            $amount = (float)($request->input('amount') ?? 0);
            $result = $this->couponService->validate($code, $amount);

            return $response->json([
                'success' => true,
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
     * Apply Coupon
     */
    public function apply(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->couponService->apply($id);

            return $response->json([
                'success' => true,
                'message' => 'Coupon applied successfully.',
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
     * Active Coupons
     */
    public function active(
        Request $request,
        Response $response
    ) {
        try {
            $coupons = $this->couponService->active();

            return $response->json([
                'success' => true,
                'data' => $coupons,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Expired Coupons
     */
    public function expired(
        Request $request,
        Response $response
    ) {
        try {
            $coupons = $this->couponService->expired();

            return $response->json([
                'success' => true,
                'data' => $coupons,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Coupon Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->couponService->statistics();

            return $response->json([
                'success' => true,
                'data' => $stats,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
