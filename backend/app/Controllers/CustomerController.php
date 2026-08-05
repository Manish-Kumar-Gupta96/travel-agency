<?php

namespace App\Controllers;

use App\Services\CustomerService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;


class CustomerController
{

    protected CustomerService $customerService;



    public function __construct(
        CustomerService $customerService
    ) {

        $this->customerService = $customerService;

    }




    /**
     * Get All Customers
     */
    public function index(
        Request $request,
        Response $response
    )
    {

        try {


            $customers =
                $this->customerService->all();



            return $response->json([

                'success' => true,

                'data' =>
                    $customers,

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
     * Get Customer Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $customer =
                $this->customerService->find(
                    $id
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $customer,

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
     * Create Customer
     */
    public function store(
        Request $request,
        Response $response
    )
    {

        try {


            $data =
                $request->all();



            $customer =
                $this->customerService->create(
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Customer created successfully.',

                'data' =>
                    $customer,

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
     * Update Customer
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



            $customer =
                $this->customerService->update(
                    $id,
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Customer updated successfully.',

                'data' =>
                    $customer,

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
     * Delete Customer
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->customerService->delete(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'Customer deleted successfully.',

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
     * Search Customers
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



            $customers =
                $this->customerService->search(
                    $keyword
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $customers,

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
    public function bookings(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $bookings =
                $this->customerService->bookings(
                    $id
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
     * Customer Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    )
    {

        try {


            $stats =
                $this->customerService->statistics();



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
