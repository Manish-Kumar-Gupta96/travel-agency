<?php

namespace App\Middleware;


use App\Services\AuthService;


use Exception;



class AuthMiddleware
{


    protected AuthService $authService;





    public function __construct(
        AuthService $authService
    )
    {

        $this->authService = $authService;

    }





    /**
     * Handle Authentication
     */
    public function handle(
        array $request,
        callable $next
    )
    {


        try
        {


            $token =

                $this->getToken(

                    $request

                );





            if(
                empty($token)
            )
            {

                throw new Exception(

                    "Authentication token required"

                );

            }





            $user =

                $this->authService->validateToken(

                    $token

                );





            if(
                !$user
            )
            {

                throw new Exception(

                    "Invalid authentication token"

                );

            }





            /*
             * Attach authenticated user
             */
            $request['user'] = $user;





            return $next(

                $request

            );


        }
        catch(Exception $e)
        {


            return [

                'status' => false,

                'code' => 401,

                'message' => $e->getMessage()

            ];

        }


    }





    /**
     * Extract Bearer Token
     */
    protected function getToken(
        array $request
    ): ?string
    {


        if(
            isset($request['headers']['Authorization'])
        )
        {


            $header =

                $request['headers']['Authorization'];





            if(
                str_starts_with(
                    $header,
                    'Bearer '
                )
            )
            {


                return trim(

                    str_replace(

                        'Bearer ',

                        '',

                        $header

                    )

                );


            }


        }





        return null;


    }





    /**
     * Check User Login Status
     */
    public function authenticated(
        array $request
    ): bool
    {


        return isset(

            $request['user']

        );


    }





}
