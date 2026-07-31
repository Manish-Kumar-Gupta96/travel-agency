<?php

declare(strict_types=1);


namespace App\Middleware;



class ApiAuthMiddleware
{


    public function handle(): bool
    {


        $token =
        $_SERVER['HTTP_AUTHORIZATION']
        ?? '';



        if(empty($token)){


            http_response_code(401);


            exit(
                json_encode(
                    [
                        'error'=>
                        'Unauthorized'
                    ]
                )
            );


        }



        return true;


    }


}
