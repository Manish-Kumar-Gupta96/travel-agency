<?php

namespace App\Models;

use App\Core\Database\Model;


class Payment extends Model
{

    protected static string $table = 'payments';


    protected array $fillable = [

        'booking_id',

        'customer_id',

        'transaction_id',

        'amount',

        'payment_method',

        'gateway',

        'gateway_response',

        'payment_status',

        'paid_at',

    ];





    /**
     * Find Payment By Transaction ID
     */
    public function findByTransactionId(
        string $transactionId
    ): ?array
    {

        return $this
            ->where(
                'transaction_id',
                $transactionId
            )
            ->first();

    }





    /**
     * Booking Payments
     */
    public function byBooking(
        int $bookingId
    ): array
    {

        return $this
            ->where(
                'booking_id',
                $bookingId
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

    }





    /**
     * Customer Payments
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
     * Completed Payments
     */
    public function completed(): array
    {

        return $this
            ->where(
                'payment_status',
                'completed'
            )
            ->get();

    }





    /**
     * Pending Payments
     */
    public function pending(): array
    {

        return $this
            ->where(
                'payment_status',
                'pending'
            )
            ->get();

    }





    /**
     * Failed Payments
     */
    public function failed(): array
    {

        return $this
            ->where(
                'payment_status',
                'failed'
            )
            ->get();

    }





    /**
     * Refunded Payments
     */
    public function refunded(): array
    {

        return $this
            ->where(
                'payment_status',
                'refunded'
            )
            ->get();

    }





    /**
     * Search Payments
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'transaction_id',
                    $keyword
                )

                ->orLike(
                    'payment_method',
                    $keyword
                )

                ->orLike(
                    'payment_status',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }





    /**
     * Update Payment Status
     */
    public function updateStatus(
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
                'amount'
            );

    }





    /**
     * Monthly Revenue
     */
    public function monthlyRevenue(
        int $month,
        int $year
    ): float
    {

        return (float)
            $this
            ->where(
                'payment_status',
                'completed'
            )
            ->whereMonth(
                'created_at',
                $month
            )
            ->whereYear(
                'created_at',
                $year
            )
            ->sum(
                'amount'
            );

    }





    /**
     * Payment Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->count(),


            'completed' =>
                $this
                ->where(
                    'payment_status',
                    'completed'
                )
                ->count(),


            'pending' =>
                $this
                ->where(
                    'payment_status',
                    'pending'
                )
                ->count(),


            'failed' =>
                $this
                ->where(
                    'payment_status',
                    'failed'
                )
                ->count(),


            'refunded' =>
                $this
                ->where(
                    'payment_status',
                    'refunded'
                )
                ->count(),


            'revenue' =>
                $this->revenue(),

        ];

    }





    /**
     * Payment With Booking
     */
    public function withBooking(
        int $id
    ): array
    {

        return $this
            ->join(
                'bookings',
                'bookings.id = payments.booking_id'
            )
            ->where(
                'payments.id',
                $id
            )
            ->first();

    }





    /**
     * Payment Full Details
     */
    public function details(
        int $id
    ): array
    {

        return $this
            ->join(
                'bookings',
                'bookings.id = payments.booking_id'
            )
            ->join(
                'customers',
                'customers.id = payments.customer_id'
            )
            ->where(
                'payments.id',
                $id
            )
            ->first();

    }


}
