<?php

namespace App\Services;

use App\Models\Destination;
use Exception;

class DestinationService
{
    protected Destination $destinationModel;

    public function __construct(
        Destination $destinationModel
    ) {
        $this->destinationModel = $destinationModel;
    }


    /**
     * Get All Destinations
     */
    public function all(): array
    {
        return $this->destinationModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Destination
     */
    public function find(
        int $id
    ): array
    {
        $destination = $this->destinationModel->find($id);

        if (!$destination) {
            throw new Exception(
                'Destination not found.'
            );
        }

        return $destination;
    }


    /**
     * Create Destination
     */
    public function create(
        array $data
    ): array
    {

        if (
            empty($data['name']) ||
            empty($data['country'])
        ) {
            throw new Exception(
                'Destination name and country are required.'
            );
        }

        $exists = $this->destinationModel
            ->where('name', $data['name'])
            ->where('country', $data['country'])
            ->first();

        if ($exists) {
            throw new Exception(
                'Destination already exists.'
            );
        }

        $id = $this->destinationModel->create([

            'name'            => $data['name'],
            'country'         => $data['country'],
            'state'           => $data['state'] ?? '',
            'city'            => $data['city'] ?? '',
            'description'     => $data['description'] ?? '',
            'short_description'=> $data['short_description'] ?? '',
            'featured_image'  => $data['featured_image'] ?? '',
            'banner_image'    => $data['banner_image'] ?? '',
            'best_time'       => $data['best_time'] ?? '',
            'currency'        => $data['currency'] ?? '',
            'language'        => $data['language'] ?? '',
            'timezone'        => $data['timezone'] ?? '',
            'status'          => $data['status'] ?? 'active',

        ]);

        return $this->find($id);
    }


    /**
     * Update Destination
     */
    public function update(
        int $id,
        array $data
    ): array
    {

        $destination = $this->find($id);

        $payload = [

            'name'              => $data['name'] ?? $destination['name'],
            'country'           => $data['country'] ?? $destination['country'],
            'state'             => $data['state'] ?? $destination['state'],
            'city'              => $data['city'] ?? $destination['city'],
            'description'       => $data['description'] ?? $destination['description'],
            'short_description' => $data['short_description'] ?? $destination['short_description'],
            'featured_image'    => $data['featured_image'] ?? $destination['featured_image'],
            'banner_image'      => $data['banner_image'] ?? $destination['banner_image'],
            'best_time'         => $data['best_time'] ?? $destination['best_time'],
            'currency'          => $data['currency'] ?? $destination['currency'],
            'language'          => $data['language'] ?? $destination['language'],
            'timezone'          => $data['timezone'] ?? $destination['timezone'],
            'status'            => $data['status'] ?? $destination['status'],

        ];

        $this->destinationModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Destination
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->destinationModel->delete($id);
    }


    /**
     * Search Destinations
     */
    public function search(
        string $keyword
    ): array
    {
        return $this->destinationModel
            ->groupStart()
                ->like('name', $keyword)
                ->orLike('country', $keyword)
                ->orLike('state', $keyword)
                ->orLike('city', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Featured Destinations
     */
    public function featured(): array
    {
        return $this->destinationModel
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

        return $this->destinationModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }


    /**
     * Destination Statistics
     */
    public function statistics(): array
    {
        return [

            'total' => $this->destinationModel->count(),

            'active' => $this->destinationModel
                ->where('status', 'active')
                ->count(),

            'inactive' => $this->destinationModel
                ->where('status', 'inactive')
                ->count(),

            'featured' => $this->destinationModel
                ->where('featured', 1)
                ->count(),

            'countries' => $this->destinationModel
                ->distinct('country')
                ->count(),

        ];
    }
}
