<?php

namespace App\Services;

use App\Models\Hotel;
use Exception;

class HotelService
{
    protected Hotel $hotelModel;

    public function __construct(
        Hotel $hotelModel
    ) {
        $this->hotelModel = $hotelModel;
    }


    /**
     * Get All Hotels
     */
    public function all(): array
    {
        return $this->hotelModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Hotel
     */
    public function find(
        int $id
    ): array
    {
        $hotel = $this->hotelModel->find($id);

        if (!$hotel) {
            throw new Exception(
                'Hotel not found.'
            );
        }

        return $hotel;
    }


    /**
     * Create Hotel
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['name']) ||
            empty($data['destination_id']) ||
            empty($data['price_per_night'])
        ) {
            throw new Exception(
                'Hotel name, destination and price are required.'
            );
        }

        $exists = $this->hotelModel
            ->where('name', $data['name'])
            ->where('destination_id', $data['destination_id'])
            ->first();

        if ($exists) {
            throw new Exception(
                'Hotel name already exists at this destination.'
            );
        }

        $id = $this->hotelModel->create([
            'destination_id' => $data['destination_id'],
            'name'           => $data['name'],
            'slug'           => $data['slug'] ?? '',
            'star_rating'    => $data['star_rating'] ?? 3,
            'address'        => $data['address'] ?? '',
            'city'           => $data['city'] ?? '',
            'country'        => $data['country'] ?? '',
            'description'    => $data['description'] ?? '',
            'image'          => $data['image'] ?? '',
            'gallery'        => $data['gallery'] ?? '',
            'amenities'      => $data['amenities'] ?? '',
            'contact_number' => $data['contact_number'] ?? '',
            'email'          => $data['email'] ?? '',
            'price_per_night'=> $data['price_per_night'],
            'available_rooms'=> $data['available_rooms'] ?? 0,
            'status'         => $data['status'] ?? 'active',
        ]);

        return $this->find($id);
    }


    /**
     * Update Hotel
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $hotel = $this->find($id);

        $payload = [
            'destination_id' => $data['destination_id'] ?? $hotel['destination_id'],
            'name'           => $data['name'] ?? $hotel['name'],
            'slug'           => $data['slug'] ?? $hotel['slug'],
            'star_rating'    => $data['star_rating'] ?? $hotel['star_rating'],
            'address'        => $data['address'] ?? $hotel['address'],
            'city'           => $data['city'] ?? $hotel['city'],
            'country'        => $data['country'] ?? $hotel['country'],
            'description'    => $data['description'] ?? $hotel['description'],
            'image'          => $data['image'] ?? $hotel['image'],
            'gallery'        => $data['gallery'] ?? $hotel['gallery'],
            'amenities'      => $data['amenities'] ?? $hotel['amenities'],
            'contact_number' => $data['contact_number'] ?? $hotel['contact_number'],
            'email'          => $data['email'] ?? $hotel['email'],
            'price_per_night'=> $data['price_per_night'] ?? $hotel['price_per_night'],
            'available_rooms'=> $data['available_rooms'] ?? $hotel['available_rooms'],
            'status'         => $data['status'] ?? $hotel['status'],
        ];

        $this->hotelModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Hotel
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->hotelModel->delete($id);
    }


    /**
     * Search Hotels
     */
    public function search(
        string $keyword
    ): array
    {
        return $this->hotelModel
            ->groupStart()
                ->like('name', $keyword)
                ->orLike('city', $keyword)
                ->orLike('country', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Hotels By Destination
     */
    public function byDestination(
        int $destinationId
    ): array
    {
        return $this->hotelModel
            ->where('destination_id', $destinationId)
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

        return $this->hotelModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }


    /**
     * Hotel Statistics
     */
    public function statistics(): array
    {
        return [
            'total' => $this->hotelModel->count(),
            'active' => $this->hotelModel
                ->where('status', 'active')
                ->count(),
            'inactive' => $this->hotelModel
                ->where('status', 'inactive')
                ->count(),
            'total_rooms' => $this->hotelModel
                ->sum('available_rooms'),
            'five_star' => $this->hotelModel
                ->where('star_rating', 5)
                ->count(),
            'four_star' => $this->hotelModel
                ->where('star_rating', 4)
                ->count(),
        ];
    }
}
