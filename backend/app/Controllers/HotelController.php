<?php

namespace App\Controllers;

use App\Services\HotelService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class HotelController
{
    protected HotelService $hotelService;

    public function __construct(
        HotelService $hotelService
    ) {
        $this->hotelService = $hotelService;
    }

    /**
     * Get All Hotels
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $hotels = $this->hotelService->all();

            return $response->json([
                'success' => true,
                'data' => $hotels,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hotel Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $hotel = $this->hotelService->find($id);

            return $response->json([
                'success' => true,
                'data' => $hotel,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Hotel
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $hotel = $this->hotelService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Hotel created successfully.',
                'data' => $hotel,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Hotel
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $hotel = $this->hotelService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Hotel updated successfully.',
                'data' => $hotel,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Hotel
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->hotelService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Hotel deleted successfully.',
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
     * Active Hotels
     */
    public function active(
        Request $request,
        Response $response
    ) {
        try {
            $hotels = $this->hotelService->active();

            return $response->json([
                'success' => true,
                'data' => $hotels,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Featured Hotels
     */
    public function featured(
        Request $request,
        Response $response
    ) {
        try {
            $hotels = $this->hotelService->featured();

            return $response->json([
                'success' => true,
                'data' => $hotels,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Destination Wise Hotels
     */
    public function destination(
        Request $request,
        Response $response,
        int $destinationId
    ) {
        try {
            $hotels = $this->hotelService->byDestination($destinationId);

            return $response->json([
                'success' => true,
                'data' => $hotels,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Search Hotels
     */
    public function search(
        Request $request,
        Response $response
    ) {
        try {
            $keyword = $request->input('keyword') ?? '';
            $hotels = $this->hotelService->search($keyword);

            return $response->json([
                'success' => true,
                'data' => $hotels,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Hotel Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->hotelService->statistics();

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
