<?php

declare(strict_types=1);


namespace App\Api;


use App\Core\Controller;



class ApiController extends Controller
{


    protected function success(
        mixed $data = [],
        string $message = 'Success'
    ): array
    {


        return [

            'status'=>true,

            'message'=>$message,

            'data'=>$data

        ];


    }





    protected function error(
        string $message,
        int $code = 400
    ): array
    {


        http_response_code($code);



        return [

            'status'=>false,

            'message'=>$message,

            'data'=>null

        ];


    }


}
