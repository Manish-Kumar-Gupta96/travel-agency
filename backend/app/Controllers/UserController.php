<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;


class UserController
{

    protected UserService $userService;



    public function __construct(
        UserService $userService
    ) {

        $this->userService = $userService;

    }




    /**
     * Get All Users
     */
    public function index(
        Request $request,
        Response $response
    )
    {

        try {


            $users =
                $this->userService->all();



            return $response->json([

                'success' => true,

                'data' =>
                    $users,

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
     * Get Single User
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $user =
                $this->userService->find(
                    $id
                );



            return $response->json([

                'success' => true,

                'data' =>
                    $user,

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
     * Create User
     */
    public function store(
        Request $request,
        Response $response
    )
    {

        try {


            $data =
                $request->all();



            $user =
                $this->userService->create(
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'User created successfully.',

                'data' =>
                    $user,

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
     * Update User
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



            $user =
                $this->userService->update(
                    $id,
                    $data
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'User updated successfully.',

                'data' =>
                    $user,

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
     * Delete User
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->userService->delete(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'User deleted successfully.',

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
     * Activate User
     */
    public function activate(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->userService->activate(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'User activated successfully.',

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
     * Deactivate User
     */
    public function deactivate(
        Request $request,
        Response $response,
        int $id
    )
    {

        try {


            $result =
                $this->userService->deactivate(
                    $id
                );



            return $response->json([

                'success' => true,

                'message' =>
                    'User deactivated successfully.',

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
     * User Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    )
    {

        try {


            $stats =
                $this->userService->statistics();



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
