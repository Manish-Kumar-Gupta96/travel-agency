<?php

declare(strict_types=1);


namespace App\Controllers\Api;


use App\Api\ApiController;
use App\Http\JsonResponse;
use App\Repositories\BookingRepository;
use App\Validation\BookingValidator;



class BookingApiController extends ApiController
{


    private BookingRepository $repository;



    public function __construct()
    {

        $this->repository = new BookingRepository();

    }





    public function store(): void
    {


        $data = [

            'name'=>trim($_POST['name'] ?? ''),

            'email'=>trim($_POST['email'] ?? ''),

            'phone'=>trim($_POST['phone'] ?? ''),

            'destination'=>trim($_POST['destination'] ?? ''),

            'travel_date'=>$_POST['travel_date'] ?? null,

            'message'=>trim($_POST['message'] ?? '')

        ];



        $errors = BookingValidator::validate($data);



        if(!empty($errors)){


            JsonResponse::send(

                $this->error(

                    'Validation failed',

                    422

                ),

                422

            );


        }



        $this->repository->createBooking($data);



        JsonResponse::send(

            $this->success(

                $data,

                'Booking created successfully'

            ),

            201

        );


    }


}
