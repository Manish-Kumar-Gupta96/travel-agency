<?php

namespace App\Controllers;

use App\Services\DestinationService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;


class DestinationController
{

    protected DestinationService $destinationService;



    public function __construct(
        DestinationService $destinationService
    ) {

        $this->destinationService = $destinationService;

    }





    /**
     * Get All Destinations
     */
    public function index(
        Request $request,
        Response $response
    )
    {

        try {


            $destinations =
                $this->destinationService->all();



            return $response->json([

                'success' => true,

                'data' =>
                    $destinations,

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
     * Get Destination Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $destination =
                $this->destinationService->find(
                    $id
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $destination,

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
     * Create Destination
     */
    public function store(
        Request $request,
        Response $response
    )
    {

        try {


            $data =
                $request->all();



            $destination =
                $this->destinationService->create(
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Destination created successfully.',

                'data' =>
                    $destination,

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
     * Update Destination
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



            $destination =
                $this->destinationService->update(
                    $id,
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Destination updated successfully.',

                'data' =>
                    $destination,

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
     * Delete Destination
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->destinationService->delete(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Destination deleted successfully.',

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
     * Search Destinations
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



            $destinations =
                $this->destinationService->search(
                    $keyword
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $destinations,

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
     * Featured Destinations
     */
    public function featured(
        Request $request,
        Response $response
    )
    {

        try {


            $destinations =
                $this->destinationService->featured();



            return $response->json([

                'success' => true,

                'data' =>
                    $destinations,

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
     * Destination Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    )
    {

        try {


            $stats =
                $this->destinationService->statistics();



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
