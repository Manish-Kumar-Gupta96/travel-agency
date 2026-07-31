<?php

declare(strict_types=1);


namespace App\Controllers\Api;


use App\Api\ApiController;
use App\Http\JsonResponse;



class DestinationApiController extends ApiController
{


    public function index(): void
    {


        $destinations = require APP_PATH .
        '/data/destinations.php';



        JsonResponse::send(

            $this->success(

                $destinations,

                'Destinations fetched successfully'

            )

        );


    }


}
