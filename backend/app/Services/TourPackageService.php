<?php

namespace App\Services;

use App\Models\TourPackage;
use Exception;

class TourPackageService
{
    protected TourPackage $tourPackageModel;

    public function __construct(
        TourPackage $tourPackageModel
    ) {
        $this->tourPackageModel = $tourPackageModel;
    }


    /**
     * Get All Tour Packages
     */
    public function all(): array
    {
        return $this->tourPackageModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Tour Package
     */
    public function find(
        int $id
    ): array
    {
        $package = $this->tourPackageModel->find($id);

        if (!$package) {
            throw new Exception(
                'Tour package not found.'
            );
        }

        return $package;
    }


    /**
     * Create Tour Package
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['title']) ||
            empty($data['destination_id']) ||
            empty($data['price'])
        ) {
            throw new Exception(
                'Title, destination and price are required.'
            );
        }

        $id = $this->tourPackageModel->create([

            'title'              => $data['title'],
            'slug'               => $data['slug'] ?? '',
            'destination_id'     => $data['destination_id'],
            'category'           => $data['category'] ?? '',
            'duration'           => $data['duration'] ?? '',
            'price'              => $data['price'],
            'discount_price'     => $data['discount_price'] ?? 0,
            'max_people'         => $data['max_people'] ?? 0,
            'description'        => $data['description'] ?? '',
            'highlights'         => $data['highlights'] ?? '',
            'itinerary'          => $data['itinerary'] ?? '',
            'included'           => $data['included'] ?? '',
            'excluded'           => $data['excluded'] ?? '',
            'featured_image'     => $data['featured_image'] ?? '',
            'gallery'            => $data['gallery'] ?? '',
            'featured'           => $data['featured'] ?? 0,
            'status'             => $data['status'] ?? 'active',

        ]);

        return $this->find($id);
    }


    /**
     * Update Tour Package
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $package = $this->find($id);

        $payload = [

            'title'          => $data['title'] ?? $package['title'],
            'slug'           => $data['slug'] ?? $package['slug'],
            'destination_id' => $data['destination_id'] ?? $package['destination_id'],
            'category'       => $data['category'] ?? $package['category'],
            'duration'       => $data['duration'] ?? $package['duration'],
            'price'          => $data['price'] ?? $package['price'],
            'discount_price' => $data['discount_price'] ?? $package['discount_price'],
            'max_people'     => $data['max_people'] ?? $package['max_people'],
            'description'    => $data['description'] ?? $package['description'],
            'highlights'     => $data['highlights'] ?? $package['highlights'],
            'itinerary'      => $data['itinerary'] ?? $package['itinerary'],
            'included'       => $data['included'] ?? $package['included'],
            'excluded'       => $data['excluded'] ?? $package['excluded'],
            'featured_image' => $data['featured_image'] ?? $package['featured_image'],
            'gallery'        => $data['gallery'] ?? $package['gallery'],
            'featured'       => $data['featured'] ?? $package['featured'],
            'status'         => $data['status'] ?? $package['status'],

        ];

        $this->tourPackageModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Tour Package
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->tourPackageModel->delete($id);
    }


    /**
     * Search Tour Packages
     */
    public function search(
        string $keyword
    ): array
    {
        return $this->tourPackageModel
            ->groupStart()
                ->like('title', $keyword)
                ->orLike('category', $keyword)
                ->orLike('description', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Featured Tour Packages
     */
    public function featured(): array
    {
        return $this->tourPackageModel
            ->where('featured', 1)
            ->where('status', 'active')
            ->get();
    }


    /**
     * Update Status
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool
    {
        $this->find($id);

        return $this->tourPackageModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }


    /**
     * Tour Package Statistics
     */
    public function statistics(): array
    {
        return [

            'total' => $this->tourPackageModel->count(),

            'active' => $this->tourPackageModel
                ->where('status', 'active')
                ->count(),

            'inactive' => $this->tourPackageModel
                ->where('status', 'inactive')
                ->count(),

            'featured' => $this->tourPackageModel
                ->where('featured', 1)
                ->count(),

            'draft' => $this->tourPackageModel
                ->where('status', 'draft')
                ->count(),

        ];
    }
}
