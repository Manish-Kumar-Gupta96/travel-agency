<?php

namespace App\Controllers;

use App\Services\VisaService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class VisaController
{
    protected VisaService $visaService;

    public function __construct(
        VisaService $visaService
    ) {
        $this->visaService = $visaService;
    }

    /**
     * Get All Visas
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $visas = $this->visaService->all();

            return $response->json([
                'success' => true,
                'data' => $visas,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Visa Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $visa = $this->visaService->find($id);

            return $response->json([
                'success' => true,
                'data' => $visa,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Visa
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $visa = $this->visaService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Visa created successfully.',
                'data' => $visa,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Visa
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $visa = $this->visaService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Visa updated successfully.',
                'data' => $visa,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Visa
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->visaService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Visa deleted successfully.',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Active Visas
     */
    public function active(
        Request $request,
        Response $response
    ) {
        try {
            $visas = $this->visaService->active();

            return $response->json([
                'success' => true,
                'data' => $visas,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Country Wise Visas
     */
    public function country(
        Request $request,
        Response $response
    ) {
        try {
            $country = $request->input('country') ?? '';
            $visas = $this->visaService->byCountry($country);

            return $response->json([
                'success' => true,
                'data' => $visas,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Search Visas
     */
    public function search(
        Request $request,
        Response $response
    ) {
        try {
            $keyword = $request->input('keyword') ?? '';
            $visas = $this->visaService->search($keyword);

            return $response->json([
                'success' => true,
                'data' => $visas,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Visa Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->visaService->statistics();

            return $response->json([
                'success' => true,
                'data' => $stats,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
