<?php

namespace App\Services;

use App\Models\Customer;
use Exception;

class CustomerService
{
    protected Customer $customerModel;

    public function __construct(
        Customer $customerModel
    ) {
        $this->customerModel = $customerModel;
    }


    /**
     * Get All Customers
     */
    public function all(): array
    {
        return $this->customerModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Customer
     */
    public function find(
        int $id
    ): array
    {
        $customer = $this->customerModel->find($id);

        if (!$customer) {
            throw new Exception(
                'Customer not found.'
            );
        }

        return $customer;
    }


    /**
     * Create Customer
     */
    public function create(
        array $data
    ): array
    {

        if (
            empty($data['first_name']) ||
            empty($data['last_name']) ||
            empty($data['email'])
        ) {
            throw new Exception(
                'Required fields are missing.'
            );
        }


        $exists = $this->customerModel
            ->where('email', $data['email'])
            ->first();

        if ($exists) {
            throw new Exception(
                'Email already exists.'
            );
        }


        $id = $this->customerModel->create([

            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? '',
            'gender'     => $data['gender'] ?? '',
            'dob'        => $data['dob'] ?? null,
            'passport'   => $data['passport'] ?? '',
            'nationality'=> $data['nationality'] ?? '',
            'address'    => $data['address'] ?? '',
            'city'       => $data['city'] ?? '',
            'country'    => $data['country'] ?? '',
            'status'     => $data['status'] ?? 'active',

        ]);

        return $this->find($id);
    }


    /**
     * Update Customer
     */
    public function update(
        int $id,
        array $data
    ): array
    {

        $customer = $this->find($id);

        $payload = [

            'first_name' => $data['first_name'] ?? $customer['first_name'],
            'last_name'  => $data['last_name'] ?? $customer['last_name'],
            'email'      => $data['email'] ?? $customer['email'],
            'phone'      => $data['phone'] ?? $customer['phone'],
            'gender'     => $data['gender'] ?? $customer['gender'],
            'dob'        => $data['dob'] ?? $customer['dob'],
            'passport'   => $data['passport'] ?? $customer['passport'],
            'nationality'=> $data['nationality'] ?? $customer['nationality'],
            'address'    => $data['address'] ?? $customer['address'],
            'city'       => $data['city'] ?? $customer['city'],
            'country'    => $data['country'] ?? $customer['country'],
            'status'     => $data['status'] ?? $customer['status'],

        ];

        $this->customerModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Customer
     */
    public function delete(
        int $id
    ): bool
    {

        $this->find($id);

        return $this->customerModel->delete($id);
    }


    /**
     * Search Customers
     */
    public function search(
        string $keyword
    ): array
    {

        return $this->customerModel
            ->groupStart()
                ->like('first_name', $keyword)
                ->orLike('last_name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
                ->orLike('passport', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Active Customers
     */
    public function active(): array
    {

        return $this->customerModel
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

        return $this->customerModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }


    /**
     * Customer Statistics
     */
    public function statistics(): array
    {

        return [

            'total' => $this->customerModel->count(),

            'active' => $this->customerModel
                ->where('status', 'active')
                ->count(),

            'inactive' => $this->customerModel
                ->where('status', 'inactive')
                ->count(),

            'verified_passports' => $this->customerModel
                ->where('passport_verified', 1)
                ->count(),

            'new_this_month' => $this->customerModel
                ->whereMonth('created_at', date('m'))
                ->count(),

        ];
    }
}
