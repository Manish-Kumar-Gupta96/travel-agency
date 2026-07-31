<?php

declare(strict_types=1);


namespace App\Controllers\Api;


use App\Api\ApiController;
use App\Http\JsonResponse;
use App\Repositories\ContactRepository;



class ContactApiController extends ApiController
{


    private ContactRepository $repository;



    public function __construct()
    {

        $this->repository = new ContactRepository();

    }





    public function store(): void
    {


        $data = [

            'name'=>trim($_POST['name'] ?? ''),

            'email'=>trim($_POST['email'] ?? ''),

            'message'=>trim($_POST['message'] ?? '')

        ];



        $this->repository->save($data);



        JsonResponse::send(

            $this->success(

                $data,

                'Message submitted successfully'

            ),

            201

        );


    }


}
