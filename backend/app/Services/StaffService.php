<?php

namespace App\Services;

use App\Models\Staff;
use Exception;

class StaffService
{
    protected Staff $staffModel;

    public function __construct(
        Staff $staffModel
    ) {
        $this->staffModel = $staffModel;
    }


    /**
     * Get All Staff
     */
    public function all(): array
    {
        return $this->staffModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Staff
     */
    public function find(
        int $id
    ): array
    {
        $staff = $this->staffModel->find($id);

        if (!$staff) {
            throw new Exception(
                'Staff member not found.'
            );
        }

        return $staff;
    }


    /**
     * Create Staff
     */
    public function create(
        array $data
    ): array
    {

        if (
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['designation'])
        ) {
            throw new Exception(
                'Required fields are missing.'
            );
        }


        $exists = $this->staffModel
            ->where('email', $data['email'])
            ->first();

        if ($exists) {
            throw new Exception(
                'Email already exists.'
            );
        }


        $id = $this->staffModel->create([

            'name'         => $data['name'],
            'email'        => $data['email'],
            'phone'        => $data['phone'] ?? '',
            'designation'  => $data['designation'],
            'department'   => $data['department'] ?? '',
            'salary'       => $data['salary'] ?? 0,
            'joining_date' => $data['joining_date'] ?? date('Y-m-d'),
            'address'      => $data['address'] ?? '',
            'status'       => $data['status'] ?? 'active',

        ]);

        return $this->find($id);
    }


    /**
     * Update Staff
     */
    public function update(
        int $id,
        array $data
    ): array
    {

        $staff = $this->find($id);

        $payload = [

            'name'         => $data['name'] ?? $staff['name'],
            'email'        => $data['email'] ?? $staff['email'],
            'phone'        => $data['phone'] ?? $staff['phone'],
            'designation'  => $data['designation'] ?? $staff['designation'],
            'department'   => $data['department'] ?? $staff['department'],
            'salary'       => $data['salary'] ?? $staff['salary'],
            'joining_date' => $data['joining_date'] ?? $staff['joining_date'],
            'address'      => $data['address'] ?? $staff['address'],
            'status'       => $data['status'] ?? $staff['status'],

        ];

        $this->staffModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }


    /**
     * Delete Staff
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->staffModel->delete($id);
    }


    /**
     * Search Staff
     */
    public function search(
        string $keyword
    ): array
    {

        return $this->staffModel
            ->groupStart()
                ->like('name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
                ->orLike('designation', $keyword)
                ->orLike('department', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Active Staff
     */
    public function active(): array
    {
        return $this->staffModel
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

        return $this->staffModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }


    /**
     * Staff Statistics
     */
    public function statistics(): array
    {

        return [

            'total' => $this->staffModel->count(),

            'active' => $this->staffModel
                ->where('status', 'active')
                ->count(),

            'inactive' => $this->staffModel
                ->where('status', 'inactive')
                ->count(),

            'departments' => $this->staffModel
                ->distinct('department')
                ->count(),

            'joined_this_month' => $this->staffModel
                ->whereMonth('joining_date', date('m'))
                ->count(),

        ];
    }
}
