<?php

namespace App\Services;

use App\Models\Review;
use Exception;

class ReviewService
{
    protected Review $reviewModel;

    public function __construct(
        Review $reviewModel
    ) {
        $this->reviewModel = $reviewModel;
    }


    /**
     * Get All Reviews
     */
    public function all(): array
    {
        return $this->reviewModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Review
     */
    public function find(
        int $id
    ): array
    {
        $review = $this->reviewModel->find($id);

        if (!$review) {
            throw new Exception(
                'Review not found.'
            );
        }

        return $review;
    }


    /**
     * Create Review
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['customer_id'])
        ) {
            throw new Exception(
                "Customer required"
            );
        }

        if (
            empty($data['rating'])
        ) {
            throw new Exception(
                "Rating required"
            );
        }

        if (
            $data['rating'] < 1 ||
            $data['rating'] > 5
        ) {
            throw new Exception(
                "Rating must be between 1 and 5"
            );
        }

        $status = $data['status'] ?? 'pending';

        $id = $this->reviewModel->create([
            'customer_id' => $data['customer_id'],
            'package_id'  => $data['package_id'] ?? null,
            'rating'      => $data['rating'],
            'comment'     => $data['comment'] ?? '',
            'status'      => $status,
            'featured'    => $data['featured'] ?? 0,
        ]);

        return $this->find($id);
    }


    /**
     * Update Review
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $review = $this->find($id);

        $payload = [
            'customer_id' => $data['customer_id'] ?? $review['customer_id'],
            'package_id'  => $data['package_id'] ?? $review['package_id'],
            'rating'      => $data['rating'] ?? $review['rating'],
            'comment'     => $data['comment'] ?? $review['comment'],
            'status'      => $data['status'] ?? $review['status'],
            'featured'    => $data['featured'] ?? $review['featured'],
        ];

        $this->reviewModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Review
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->reviewModel->delete($id);
    }


    /**
     * Approve Review
     */
    public function approve(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->reviewModel->update(
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
        $this->find($id);

        return $this->reviewModel->update(
            $id,
            [
                'status' => 'rejected'
            ]
        );
    }


    /**
     * Package Reviews
     */
    public function packageReviews(
        int $packageId
    ): array
    {
        return $this->reviewModel
            ->where('package_id', $packageId)
            ->where('status', 'approved')
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Customer Reviews
     */
    public function customerReviews(
        int $customerId
    ): array
    {
        return $this->reviewModel
            ->where('customer_id', $customerId)
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Featured Reviews
     */
    public function featured(): array
    {
        return $this->reviewModel
            ->where('featured', 1)
            ->where('status', 'approved')
            ->get();
    }


    /**
     * Rating Summary
     */
    public function ratingSummary(): array
    {
        $total = $this->reviewModel->count();
        $average = $this->reviewModel->sum('rating');
        $avgRating = $total > 0 ? (float) ($average / $total) : 0.0;

        return [
            'average_rating' => $avgRating,
            'total_reviews'  => $total,
            '5_star'         => $this->reviewModel->where('rating', 5)->count(),
            '4_star'         => $this->reviewModel->where('rating', 4)->count(),
            '3_star'         => $this->reviewModel->where('rating', 3)->count(),
            '2_star'         => $this->reviewModel->where('rating', 2)->count(),
            '1_star'         => $this->reviewModel->where('rating', 1)->count(),
        ];
    }


    /**
     * Pending Reviews
     */
    public function pending(): array
    {
        return $this->reviewModel
            ->where('status', 'pending')
            ->get();
    }


    /**
     * Statistics
     */
    public function statistics(): array
    {
        return [
            'total_reviews' => $this->reviewModel->count()
        ];
    }
}
