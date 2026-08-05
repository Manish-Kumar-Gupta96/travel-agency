<?php

namespace App\Controllers;

use App\Services\BookingService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;


class BookingController
{

    protected BookingService $bookingService;



    public function __construct(
        BookingService $bookingService
    ) {

        $this->bookingService = $bookingService;

    }





    /**
     * Get All Bookings
     */
    public function index(
        Request $request,
        Response $response
    )
    {

        try {


            $bookings =
                $this->bookingService->all();



            return $response->json([

                'success' => true,

                'data' =>
                    $bookings,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],500);


        }

    }





    /**
     * Booking Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $booking =
                $this->bookingService->find(
                    $id
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $booking,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],404);


        }

    }





    /**
     * Create Booking
     */
    public function store(
        Request $request,
        Response $response
    )
    {

        try {


            $data =
                $request->all();



            $booking =
                $this->bookingService->create(
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Booking created successfully.',

                'data' =>
                    $booking,

            ],201);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Update Booking
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $data =
                $request->all();



            $booking =
                $this->bookingService->update(
                    $id,
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Booking updated successfully.',

                'data' =>
                    $booking,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Cancel Booking
     */
    public function cancel(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->bookingService->cancel(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Booking cancelled successfully.',

                'data' =>
                    $result,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Delete Booking
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->bookingService->delete(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Booking deleted successfully.',

                'data' =>
                    $result,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Customer Booking History
     */
    public function customerBookings(
        Request $request,
        Response $response,
        int $customerId
    )
    {

        try {


            $bookings =
                $this->bookingService
                ->customerBookings(
                    $customerId
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $bookings,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Booking Status Update
     */
    public function status(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $status =
                $request->input(
                    'status'
                );



            $result =
                $this->bookingService
                ->updateStatus(
                    $id,
                    $status
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Booking status updated.',

                'data' =>
                    $result,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Search Booking
     */
    public function search(
        Request $request,
        Response $response
    )
    {

        try {


            $keyword =
                $request->input(
                    'keyword'
                );



            $bookings =
                $this->bookingService
                ->search(
                    $keyword
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $bookings,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],400);


        }

    }





    /**
     * Booking Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    )
    {

        try {


            $stats =
                $this->bookingService
                ->statistics();



            return $response->json([

                'success' => true,

                'data' =>
                    $stats,

            ]);



        } catch (Exception $e) {


            return $response->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],500);


        }

    }


}
