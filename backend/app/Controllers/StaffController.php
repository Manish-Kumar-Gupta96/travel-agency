<?php

namespace App\Controllers;

use App\Services\StaffService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;


class StaffController
{

    protected StaffService $staffService;



    public function __construct(
        StaffService $staffService
    ) {

        $this->staffService = $staffService;

    }





    /**
     * Get All Staff
     */
    public function index(
        Request $request,
        Response $response
    )
    {

        try {


            $staff =
                $this->staffService->all();



            return $response->json([

                'success' => true,

                'data' =>
                    $staff,

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
     * Get Staff Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $staff =
                $this->staffService->find(
                    $id
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $staff,

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
     * Create Staff
     */
    public function store(
        Request $request,
        Response $response
    )
    {

        try {


            $data =
                $request->all();



            $staff =
                $this->staffService->create(
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Staff created successfully.',

                'data' =>
                    $staff,

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
     * Update Staff
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



            $staff =
                $this->staffService->update(
                    $id,
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Staff updated successfully.',

                'data' =>
                    $staff,

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
     * Delete Staff
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->staffService->delete(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Staff deleted successfully.',

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
     * Search Staff
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



            $staff =
                $this->staffService->search(
                    $keyword
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $staff,

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
     * Activate Staff
     */
    public function activate(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->staffService->activate(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Staff activated successfully.',

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
     * Deactivate Staff
     */
    public function deactivate(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->staffService->deactivate(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Staff deactivated successfully.',

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
     * Staff Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    )
    {

        try {


            $stats =
                $this->staffService->statistics();



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
