<?php

namespace App\Controllers;

use App\Services\TourPackageService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;


class TourPackageController
{

    protected TourPackageService $tourPackageService;



    public function __construct(
        TourPackageService $tourPackageService
    ) {

        $this->tourPackageService = $tourPackageService;

    }





    /**
     * Get All Tour Packages
     */
    public function index(
        Request $request,
        Response $response
    )
    {

        try {


            $packages =
                $this->tourPackageService->all();



            return $response->json([

                'success' => true,

                'data' =>
                    $packages,

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
     * Get Package Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $package =
                $this->tourPackageService->find(
                    $id
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $package,

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
     * Create Package
     */
    public function store(
        Request $request,
        Response $response
    )
    {

        try {


            $data =
                $request->all();



            $package =
                $this->tourPackageService->create(
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Tour package created successfully.',

                'data' =>
                    $package,

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
     * Update Package
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



            $package =
                $this->tourPackageService->update(
                    $id,
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Tour package updated successfully.',

                'data' =>
                    $package,

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
     * Delete Package
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->tourPackageService->delete(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Tour package deleted successfully.',

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
     * Search Packages
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



            $packages =
                $this->tourPackageService->search(
                    $keyword
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $packages,

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
     * Featured Packages
     */
    public function featured(
        Request $request,
        Response $response
    )
    {

        try {


            $packages =
                $this->tourPackageService->featured();



            return $response->json([

                'success' => true,

                'data' =>
                    $packages,

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
     * Category Filter
     */
    public function category(
        Request $request,
        Response $response
    )
    {

        try {


            $category =
                $request->input(
                    'category'
                );



            $packages =
                $this->tourPackageService->byCategory(
                    $category
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $packages,

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
     * Package Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    )
    {

        try {


            $stats =
                $this->tourPackageService->statistics();



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
