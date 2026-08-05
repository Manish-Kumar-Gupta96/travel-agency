<?php

namespace App\Middleware;


use Exception;



class CsrfMiddleware
{


    protected string $sessionKey = 'csrf_token';





    /**
     * Handle CSRF Protection
     */
    public function handle(
        array $request,
        callable $next
    )
    {


        try
        {


            $method =

                strtoupper(

                    $request['method']
                    ?? 'GET'

                );





            /*
             * Safe Methods
             */
            if(
                in_array(

                    $method,

                    [

                        'GET',

                        'HEAD',

                        'OPTIONS'

                    ],

                    true

                )
            )
            {

                return $next(

                    $request

                );

            }





            $token =

                $this->getRequestToken(

                    $request

                );





            if(
                !$this->validateToken(

                    $token

                )
            )
            {

                throw new Exception(

                    "Invalid CSRF token"

                );

            }





            return $next(

                $request

            );


        }
        catch(Exception $e)
        {


            return [

                'status' => false,

                'code' => 419,

                'message' => $e->getMessage()

            ];


        }


    }





    /**
     * Generate CSRF Token
     */
    public function generateToken(): string
    {


        $token =

            bin2hex(

                random_bytes(

                    32

                )

            );





        $_SESSION[$this->sessionKey] = $token;





        return $token;


    }





    /**
     * Get Stored Token
     */
    public function getToken(): ?string
    {


        return $_SESSION[$this->sessionKey]
            ?? null;


    }





    /**
     * Validate Token
     */
    public function validateToken(
        ?string $token
    ): bool
    {


        if(
            empty($token)
        )
        {

            return false;

        }





        $sessionToken =

            $this->getToken();





        if(
            empty($sessionToken)
        )
        {

            return false;

        }





        return hash_equals(

            $sessionToken,

            $token

        );


    }





    /**
     * Extract Token From Request
     */
    protected function getRequestToken(
        array $request
    ): ?string
    {


        if(
            isset(
                $request['headers']['X-CSRF-TOKEN']
            )
        )
        {

            return $request['headers']['X-CSRF-TOKEN'];

        }





        if(
            isset(
                $request['csrf_token']
            )
        )
        {

            return $request['csrf_token'];

        }





        return null;


    }





    /**
     * Refresh Token
     */
    public function refresh(): string
    {


        return $this->generateToken();


    }





    /**
     * Remove Token
     */
    public function destroy(): void
    {


        unset(

            $_SESSION[$this->sessionKey]

        );


    }





}
