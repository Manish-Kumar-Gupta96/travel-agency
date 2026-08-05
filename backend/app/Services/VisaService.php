<?php

namespace App\Services;

use App\Models\Visa;
use Exception;

class VisaService
{
    protected Visa $visaModel;

    public function __construct(
        Visa $visaModel
    ) {
        $this->visaModel = $visaModel;
    }


    /**
     * Get All Visas
     */
    public function all(): array
    {
        return $this->visaModel
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * Find Visa
     */
    public function find(
        int $id
    ): array
    {
        $visa = $this->visaModel->find($id);

        if (!$visa) {
            throw new Exception('Visa not found.');
        }

        return $visa;
    }


    /**
     * Create Visa
     */
    public function create(
        array $data
    ): array
    {
        if (
            empty($data['country']) ||
            empty($data['visa_type']) ||
            empty($data['price'])
        ) {
            throw new Exception('Country, visa type and price are required.');
        }

        $exists = $this->visaModel
            ->where('country', $data['country'])
            ->where('visa_type', $data['visa_type'])
            ->first();

        if ($exists) {
            throw new Exception('Visa requirement for this country and type already exists.');
        }

        $id = $this->visaModel->create([
            'country'         => $data['country'],
            'visa_type'       => $data['visa_type'],
            'processing_time' => $data['processing_time'] ?? '',
            'price'           => $data['price'],
            'requirements'    => $data['requirements'] ?? '',
            'status'          => $data['status'] ?? 'active',
        ]);

        return $this->find($id);
    }


    /**
     * Update Visa
     */
    public function update(
        int $id,
        array $data
    ): array
    {
        $visa = $this->find($id);

        $payload = [
            'country'         => $data['country'] ?? $visa['country'],
            'visa_type'       => $data['visa_type'] ?? $visa['visa_type'],
            'processing_time' => $data['processing_time'] ?? $visa['processing_time'],
            'price'           => $data['price'] ?? $visa['price'],
            'requirements'    => $data['requirements'] ?? $visa['requirements'],
            'status'          => $data['status'] ?? $visa['status'],
        ];

        $this->visaModel->update($id, $payload);

        return $this->find($id);
    }


    /**
     * Delete Visa
     */
    public function delete(
        int $id
    ): bool
    {
        $this->find($id);

        return $this->visaModel->delete($id);
    }


    /**
     * Search Visas
     */
    public function search(
        string $keyword
    ): array
    {
        return $this->visaModel
            ->groupStart()
                ->like('country', $keyword)
                ->orLike('visa_type', $keyword)
            ->groupEnd()
            ->get();
    }


    /**
     * Get Active Visas
     */
    public function active(): array
    {
        return $this->visaModel
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

        return $this->visaModel->update($id, ['status' => $status]);
    }


    /**
     * Visa Statistics
     */
    public function statistics(): array
    {
        return [
            'total' => $this->visaModel->count(),
            'active' => $this->visaModel
                ->where('status', 'active')
                ->count(),
            'inactive' => $this->visaModel
                ->where('status', 'inactive')
                ->count(),
            'countries' => $this->visaModel
                ->distinct('country')
                ->count(),
        ];
    }
}
