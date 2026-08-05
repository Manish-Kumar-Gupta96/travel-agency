<?php

namespace App\Controllers;

use App\Services\ReviewService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class ReviewController
{
    protected ReviewService $reviewService;

    public function __construct(
        ReviewService $reviewService
    ) {
        $this->reviewService = $reviewService;
    }

    /**
     * Get All Reviews
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $reviews = $this->reviewService->all();

            return $response->json([
                'success' => true,
                'data' => $reviews,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Review Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $review = $this->reviewService->find($id);

            return $response->json([
                'success' => true,
                'data' => $review,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Review
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $review = $this->reviewService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Review created successfully.',
                'data' => $review,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Review
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $review = $this->reviewService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Review updated successfully.',
                'data' => $review,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Review
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->reviewService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Review deleted successfully.',
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
     * Approve Review
     */
    public function approve(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->reviewService->approve($id);

            return $response->json([
                'success' => true,
                'message' => 'Review approved successfully.',
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
     * Reject Review
     */
    public function reject(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->reviewService->reject($id);

            return $response->json([
                'success' => true,
                'message' => 'Review rejected successfully.',
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
     * Package Reviews
     */
    public function package(
        Request $request,
        Response $response,
        int $packageId
    ) {
        try {
            $reviews = $this->reviewService->byPackage($packageId);

            return $response->json([
                'success' => true,
                'data' => $reviews,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Customer Reviews
     */
    public function customer(
        Request $request,
        Response $response,
        int $customerId
    ) {
        try {
            $reviews = $this->reviewService->byCustomer($customerId);

            return $response->json([
                'success' => true,
                'data' => $reviews,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Featured Reviews
     */
    public function featured(
        Request $request,
        Response $response
    ) {
        try {
            $reviews = $this->reviewService->featured();

            return $response->json([
                'success' => true,
                'data' => $reviews,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Pending Reviews
     */
    public function pending(
        Request $request,
        Response $response
    ) {
        try {
            $reviews = $this->reviewService->pending();

            return $response->json([
                'success' => true,
                'data' => $reviews,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Review Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->reviewService->statistics();

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
