<?php

namespace App\Services;

use App\Models\Booking;
use Exception;

class BookingService
{
    protected Booking $bookingModel;


    public function __construct(
        Booking $bookingModel
    ) {
        $this->bookingModel = $bookingModel;
    }



    /**
     * Get All Bookings
     */
    public function all(): array
    {
        return $this->bookingModel
            ->orderBy('id', 'DESC')
            ->get();
    }



    /**
     * Find Booking
     */
    public function find(
        int $id
    ): array {

        $booking = $this->bookingModel->find($id);


        if (!$booking) {

            throw new Exception(
                'Booking not found.'
            );

        }


        return $booking;
    }



    /**
     * Create Booking
     */
    public function create(
        array $data
    ): array {


        if (
            empty($data['customer_id']) ||
            empty($data['package_id'])
        ) {

            throw new Exception(
                'Customer and package are required.'
            );

        }



        $bookingNumber = 'BK' .
            date('Ymd') .
            rand(1000,9999);



        $id = $this->bookingModel->create([

            'booking_number' => $bookingNumber,

            'customer_id' =>
                $data['customer_id'],

            'package_id' =>
                $data['package_id'],

            'flight_id' =>
                $data['flight_id'] ?? null,

            'hotel_id' =>
                $data['hotel_id'] ?? null,

            'travel_date' =>
                $data['travel_date'] ?? null,

            'persons' =>
                $data['persons'] ?? 1,

            'total_amount' =>
                $data['total_amount'] ?? 0,

            'discount_amount' =>
                $data['discount_amount'] ?? 0,

            'final_amount' =>
                $data['final_amount'] ?? 0,

            'payment_status' =>
                $data['payment_status'] ?? 'pending',

            'booking_status' =>
                $data['booking_status'] ?? 'pending',

            'notes' =>
                $data['notes'] ?? '',

        ]);



        return $this->find($id);

    }



    /**
     * Update Booking
     */
    public function update(
        int $id,
        array $data
    ): array {


        $booking = $this->find($id);



        $payload = [

            'travel_date' =>
                $data['travel_date']
                ?? $booking['travel_date'],

            'persons' =>
                $data['persons']
                ?? $booking['persons'],

            'total_amount' =>
                $data['total_amount']
                ?? $booking['total_amount'],

            'discount_amount' =>
                $data['discount_amount']
                ?? $booking['discount_amount'],

            'final_amount' =>
                $data['final_amount']
                ?? $booking['final_amount'],

            'payment_status' =>
                $data['payment_status']
                ?? $booking['payment_status'],

            'booking_status' =>
                $data['booking_status']
                ?? $booking['booking_status'],

            'notes' =>
                $data['notes']
                ?? $booking['notes'],

        ];



        $this->bookingModel->update(
            $id,
            $payload
        );


        return $this->find($id);

    }



    /**
     * Delete Booking
     */
    public function delete(
        int $id
    ): bool {


        $this->find($id);


        return $this->bookingModel->delete($id);

    }



    /**
     * Search Bookings
     */
    public function search(
        string $keyword
    ): array {


        return $this->bookingModel
            ->groupStart()
                ->like(
                    'booking_number',
                    $keyword
                )
                ->orLike(
                    'payment_status',
                    $keyword
                )
                ->orLike(
                    'booking_status',
                    $keyword
                )
            ->groupEnd()
            ->get();

    }



    /**
     * Customer Bookings
     */
    public function customerBookings(
        int $customerId
    ): array {


        return $this->bookingModel
            ->where(
                'customer_id',
                $customerId
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

    }



    /**
     * Update Booking Status
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool {


        $this->find($id);


        return $this->bookingModel->update(
            $id,
            [

                'booking_status' => $status

            ]
        );

    }



    /**
     * Confirm Booking
     */
    public function confirm(
        int $id
    ): bool {


        return $this->updateStatus(
            $id,
            'confirmed'
        );

    }



    /**
     * Cancel Booking
     */
    public function cancel(
        int $id
    ): bool {


        return $this->updateStatus(
            $id,
            'cancelled'
        );

    }



    /**
     * Booking Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->bookingModel->count(),


            'pending' =>
                $this->bookingModel
                ->where(
                    'booking_status',
                    'pending'
                )
                ->count(),


            'confirmed' =>
                $this->bookingModel
                ->where(
                    'booking_status',
                    'confirmed'
                )
                ->count(),


            'cancelled' =>
                $this->bookingModel
                ->where(
                    'booking_status',
                    'cancelled'
                )
                ->count(),


            'revenue' =>
                $this->bookingModel
                ->sum('final_amount'),

        ];

    }

}
