<?php

namespace App\Services;

use App\Models\Flight;
use Exception;

class FlightService
{
    protected Flight $flightModel;

    public function __construct(
        Flight $flightModel
    ) {
        $this->flightModel = $flightModel;
    }


    /**
     * Get All Flights
     */
    public function all(): array
    {
        return $this->flightModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Flight
     */
    public function find(
        int $id
    ): array
    {
        $flight = $this->flightModel->find($id);

        if (!$flight) {
            throw new Exception('Flight not found.');
        }

        return $flight;
    }


    /**
     * Create Flight
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['flight_number']) ||
            empty($data['airline']) ||
            empty($data['price'])
        ) {
            throw new Exception('Flight number, airline and price are required.');
        }

        $exists = $this->flightModel
            ->where('flight_number', $data['flight_number'])
            ->first();

        if ($exists) {
            throw new Exception('Flight number already exists.');
        }

        $id = $this->flightModel->create([
            'flight_number'     => $data['flight_number'],
            'airline'           => $data['airline'],
            'departure_airport' => $data['departure_airport'] ?? '',
            'arrival_airport'   => $data['arrival_airport'] ?? '',
            'departure_time'    => $data['departure_time'] ?? null,
            'arrival_time'      => $data['arrival_time'] ?? null,
            'price'             => $data['price'],
            'available_seats'   => $data['available_seats'] ?? 0,
            'status'            => $data['status'] ?? 'active',
        ]);

        return $this->find($id);
    }


    /**
     * Update Flight
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $flight = $this->find($id);

        $payload = [
            'flight_number'     => $data['flight_number'] ?? $flight['flight_number'],
            'airline'           => $data['airline'] ?? $flight['airline'],
            'departure_airport' => $data['departure_airport'] ?? $flight['departure_airport'],
            'arrival_airport'   => $data['arrival_airport'] ?? $flight['arrival_airport'],
            'departure_time'    => $data['departure_time'] ?? $flight['departure_time'],
            'arrival_time'      => $data['arrival_time'] ?? $flight['arrival_time'],
            'price'             => $data['price'] ?? $flight['price'],
            'available_seats'   => $data['available_seats'] ?? $flight['available_seats'],
            'status'            => $data['status'] ?? $flight['status'],
        ];

        $this->flightModel->update($id, $payload);

        return $this->find($id);
    }


    /**
     * Delete Flight
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->flightModel->delete($id);
    }


    /**
     * Search Flights
     */
    public function search(
        string $keyword
    ): array
    {
        return $this->flightModel
            ->groupStart()
                ->like('flight_number', $keyword)
                ->orLike('airline', $keyword)
                ->orLike('departure_airport', $keyword)
                ->orLike('arrival_airport', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Get Active Flights
     */
    public function active(): array
    {
        return $this->flightModel
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

        return $this->flightModel->update($id, ['status' => $status]);
    }


    /**
     * Flight Statistics
     */
    public function statistics(): array
    {
        return [
            'total' => $this->flightModel->count(),
            'active' => $this->flightModel
                ->where('status', 'active')
                ->count(),
            'inactive' => $this->flightModel
                ->where('status', 'inactive')
                ->count(),
            'total_seats' => $this->flightModel->sum('available_seats'),
        ];
    }
}
