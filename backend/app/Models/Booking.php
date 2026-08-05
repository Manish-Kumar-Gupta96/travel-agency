<?php

namespace App\Models;

use App\Core\Database\Model;


class Booking extends Model
{

    protected static string $table = 'bookings';


    protected array $fillable = [

        'booking_number',

        'customer_id',

        'package_id',

        'flight_id',

        'hotel_id',

        'travel_date',

        'persons',

        'total_amount',

        'discount_amount',

        'final_amount',

        'payment_status',

        'booking_status',

        'notes',

    ];





    /**
     * Find Booking Number
     */
    public function findByBookingNumber(
        string $number
    ): ?array
    {

        return $this
            ->where(
                'booking_number',
                $number
            )
            ->first();

    }





    /**
     * Customer Bookings
     */
    public function byCustomer(
        int $customerId
    ): array
    {

        return $this
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
     * Package Bookings
     */
    public function byPackage(
        int $packageId
    ): array
    {

        return $this
            ->where(
                'package_id',
                $packageId
            )
            ->get();

    }





    /**
     * Pending Bookings
     */
    public function pending(): array
    {

        return $this
            ->where(
                'booking_status',
                'pending'
            )
            ->get();

    }





    /**
     * Confirmed Bookings
     */
    public function confirmed(): array
    {

        return $this
            ->where(
                'booking_status',
                'confirmed'
            )
            ->get();

    }





    /**
     * Cancelled Bookings
     */
    public function cancelled(): array
    {

        return $this
            ->where(
                'booking_status',
                'cancelled'
            )
            ->get();

    }





    /**
     * Search Booking
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
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
     * Update Booking Status
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool
    {

        return $this->update(
            $id,
            [

                'booking_status' => $status

            ]
        );

    }





    /**
     * Update Payment Status
     */
    public function updatePaymentStatus(
        int $id,
        string $status
    ): bool
    {

        return $this->update(
            $id,
            [

                'payment_status' => $status

            ]
        );

    }





    /**
     * Total Revenue
     */
    public function revenue(): float
    {

        return (float)
            $this
            ->where(
                'payment_status',
                'completed'
            )
            ->sum(
                'final_amount'
            );

    }





    /**
     * Booking Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->count(),


            'pending' =>
                $this
                ->where(
                    'booking_status',
                    'pending'
                )
                ->count(),


            'confirmed' =>
                $this
                ->where(
                    'booking_status',
                    'confirmed'
                )
                ->count(),


            'cancelled' =>
                $this
                ->where(
                    'booking_status',
                    'cancelled'
                )
                ->count(),


            'revenue' =>
                $this->revenue(),

        ];

    }





    /**
     * Booking With Customer
     */
    public function withCustomer(
        int $id
    ): array
    {

        return $this
            ->join(
                'customers',
                'customers.id = bookings.customer_id'
            )
            ->where(
                'bookings.id',
                $id
            )
            ->first();

    }





    /**
     * Booking Full Details
     */
    public function details(
        int $id
    ): array
    {

        return $this
            ->join(
                'customers',
                'customers.id = bookings.customer_id'
            )
            ->join(
                'tour_packages',
                'tour_packages.id = bookings.package_id'
            )
            ->where(
                'bookings.id',
                $id
            )
            ->first();

    }


}
