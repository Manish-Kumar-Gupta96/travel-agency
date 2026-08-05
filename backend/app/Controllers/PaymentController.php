<?php

namespace App\Controllers;

use App\Services\PaymentService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class PaymentController
{
    protected PaymentService $paymentService;

    public function __construct(
        PaymentService $paymentService
    ) {
        $this->paymentService = $paymentService;
    }

    /**
     * Get All Payments
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $payments = $this->paymentService->all();

            return $response->json([
                'success' => true,
                'data' => $payments,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Payment Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $payment = $this->paymentService->find($id);

            return $response->json([
                'success' => true,
                'data' => $payment,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Payment
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $payment = $this->paymentService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Payment created successfully.',
                'data' => $payment,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Payment
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $payment = $this->paymentService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Payment updated successfully.',
                'data' => $payment,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Payment
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->paymentService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Payment deleted successfully.',
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
     * Booking Payments
     */
    public function booking(
        Request $request,
        Response $response,
        int $bookingId
    ) {
        try {
            $payments = $this->paymentService->bookingPayments($bookingId);

            return $response->json([
                'success' => true,
                'data' => $payments,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Customer Payments
     */
    public function customer(
        Request $request,
        Response $response,
        int $customerId
    ) {
        try {
            $payments = $this->paymentService->customerPayments($customerId);

            return $response->json([
                'success' => true,
                'data' => $payments,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Search Payments
     */
    public function search(
        Request $request,
        Response $response
    ) {
        try {
            $keyword = $request->input('keyword') ?? '';
            $payments = $this->paymentService->search($keyword);

            return $response->json([
                'success' => true,
                'data' => $payments,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Payment Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->paymentService->statistics();

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
