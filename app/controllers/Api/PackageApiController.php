<?php

declare(strict_types=1);


namespace App\Controllers\Api;


use App\Api\ApiController;
use App\Http\JsonResponse;



class PackageApiController extends ApiController
{


    public function index(): void
    {


        $packages = require APP_PATH .
        '/data/packages.php';



        JsonResponse::send(

            $this->success(

                $packages,

                'Packages fetched successfully'

            )

        );


    }


}
