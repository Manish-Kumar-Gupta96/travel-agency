<?php

declare(strict_types=1);


namespace App\Api;


use Throwable;
use App\Http\JsonResponse;



class ApiExceptionHandler
{


    public static function handle(
        Throwable $exception
    ): void
    {


        JsonResponse::send(

            [

                'status'=>false,

                'message'=>
                'Something went wrong',

                'error'=>
                $exception->getMessage()

            ],

            500

        );


    }


}
