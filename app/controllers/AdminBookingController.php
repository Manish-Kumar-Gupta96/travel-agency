<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;
use App\Repositories\BookingRepository;



class AdminBookingController extends Controller
{


    private BookingRepository $repository;



    public function __construct()
    {

        $this->repository = new BookingRepository();

    }




    public function index()
    {


        $bookings = $this->repository->getAll();



        return $this->view(

            'admin/bookings/index',

            [

                'title'=>'Manage Bookings',

                'bookings'=>$bookings

            ]

        );


    }



}
