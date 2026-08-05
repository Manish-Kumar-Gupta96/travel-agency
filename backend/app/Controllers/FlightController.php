<?php

namespace App\Controllers;

use App\Services\FlightService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class FlightController
{
    protected FlightService $flightService;

    public function __construct(
        FlightService $flightService
    ) {
        $this->flightService = $flightService;
    }

    /**
     * Get All Flights
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $flights = $this->flightService->all();

            return $response->json([
                'success' => true,
                'data' => $flights,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Flight Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $flight = $this->flightService->find($id);

            return $response->json([
                'success' => true,
                'data' => $flight,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Flight
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $flight = $this->flightService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Flight created successfully.',
                'data' => $flight,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Flight
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $flight = $this->flightService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Flight updated successfully.',
                'data' => $flight,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Flight
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->flightService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Flight deleted successfully.',
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
     * Active Flights
     */
    public function active(
        Request $request,
        Response $response
    ) {
        try {
            $flights = $this->flightService->active();

            return $response->json([
                'success' => true,
                'data' => $flights,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Airline Wise Flights
     */
    public function airline(
        Request $request,
        Response $response
    ) {
        try {
            $airline = $request->input('airline') ?? '';
            $flights = $this->flightService->byAirline($airline);

            return $response->json([
                'success' => true,
                'data' => $flights,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Route Wise Flights
     */
    public function route(
        Request $request,
        Response $response
    ) {
        try {
            $departure = $request->input('departure_city') ?? $request->input('departure') ?? '';
            $arrival = $request->input('arrival_city') ?? $request->input('arrival') ?? '';
            $flights = $this->flightService->byRoute($departure, $arrival);

            return $response->json([
                'success' => true,
                'data' => $flights,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Search Flights
     */
    public function search(
        Request $request,
        Response $response
    ) {
        try {
            $keyword = $request->input('keyword') ?? '';
            $flights = $this->flightService->search($keyword);

            return $response->json([
                'success' => true,
                'data' => $flights,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Flight Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->flightService->statistics();

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
