<?php

namespace App\Services;

use App\Models\Payment;
use Exception;

class PaymentService
{
    protected Payment $paymentModel;


    public function __construct(
        Payment $paymentModel
    ) {
        $this->paymentModel = $paymentModel;
    }



    /**
     * Get All Payments
     */
    public function all(): array
    {
        return $this->paymentModel
            ->orderBy('id', 'DESC')
            ->get();
    }



    /**
     * Find Payment
     */
    public function find(
        int $id
    ): array {

        $payment = $this->paymentModel->find($id);


        if (!$payment) {

            throw new Exception(
                'Payment not found.'
            );

        }


        return $payment;

    }



    /**
     * Create Payment
     */
    public function create(
        array $data
    ): array {


        if (
            empty($data['booking_id']) ||
            empty($data['amount'])
        ) {

            throw new Exception(
                'Booking and amount are required.'
            );

        }



        $transactionId =
            'TXN' .
            date('YmdHis') .
            rand(100,999);



        $id = $this->paymentModel->create([

            'booking_id' =>
                $data['booking_id'],

            'customer_id' =>
                $data['customer_id'] ?? null,

            'transaction_id' =>
                $transactionId,

            'amount' =>
                $data['amount'],

            'payment_method' =>
                $data['payment_method'] ?? 'cash',

            'gateway' =>
                $data['gateway'] ?? '',

            'gateway_response' =>
                $data['gateway_response'] ?? '',

            'payment_status' =>
                $data['payment_status'] ?? 'pending',

            'paid_at' =>
                $data['paid_at'] ?? null,

        ]);



        return $this->find($id);

    }




    /**
     * Update Payment
     */
    public function update(
        int $id,
        array $data
    ): array {


        $payment = $this->find($id);



        $payload = [

            'amount' =>
                $data['amount']
                ?? $payment['amount'],

            'payment_method' =>
                $data['payment_method']
                ?? $payment['payment_method'],

            'gateway' =>
                $data['gateway']
                ?? $payment['gateway'],

            'gateway_response' =>
                $data['gateway_response']
                ?? $payment['gateway_response'],

            'payment_status' =>
                $data['payment_status']
                ?? $payment['payment_status'],

            'paid_at' =>
                $data['paid_at']
                ?? $payment['paid_at'],

        ];



        $this->paymentModel->update(
            $id,
            $payload
        );


        return $this->find($id);

    }




    /**
     * Delete Payment
     */
    public function delete(
        int $id
    ): bool {


        $this->find($id);


        return $this->paymentModel->delete($id);

    }




    /**
     * Search Payments
     */
    public function search(
        string $keyword
    ): array {


        return $this->paymentModel
            ->groupStart()
                ->like(
                    'transaction_id',
                    $keyword
                )
                ->orLike(
                    'payment_status',
                    $keyword
                )
                ->orLike(
                    'payment_method',
                    $keyword
                )
            ->groupEnd()
            ->get();

    }




    /**
     * Booking Payments
     */
    public function bookingPayments(
        int $bookingId
    ): array {


        return $this->paymentModel
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
     * Update Payment Status
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool {


        $this->find($id);


        return $this->paymentModel->update(
            $id,
            [

                'payment_status' => $status

            ]
        );

    }




    /**
     * Mark Payment Success
     */
    public function success(
        int $id
    ): bool {


        return $this->updateStatus(
            $id,
            'completed'
        );

    }




    /**
     * Refund Payment
     */
    public function refund(
        int $id
    ): bool {


        return $this->updateStatus(
            $id,
            'refunded'
        );

    }




    /**
     * Payment Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->paymentModel->count(),


            'completed' =>
                $this->paymentModel
                ->where(
                    'payment_status',
                    'completed'
                )
                ->count(),


            'pending' =>
                $this->paymentModel
                ->where(
                    'payment_status',
                    'pending'
                )
                ->count(),


            'failed' =>
                $this->paymentModel
                ->where(
                    'payment_status',
                    'failed'
                )
                ->count(),


            'refunded' =>
                $this->paymentModel
                ->where(
                    'payment_status',
                    'refunded'
                )
                ->count(),


            'revenue' =>
                $this->paymentModel
                ->where(
                    'payment_status',
                    'completed'
                )
                ->sum('amount'),

        ];

    }

}
