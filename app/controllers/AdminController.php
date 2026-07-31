<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;
use App\Repositories\BookingRepository;



class AdminController extends Controller
{


    private BookingRepository $bookingRepository;



    public function __construct()
    {

        $this->bookingRepository = new BookingRepository();

    }




    public function dashboard()
    {


        $bookings = $this->bookingRepository->getAll();



        return $this->view(

            'admin/dashboard',

            [

                'title'=>'Admin Dashboard',

                'bookings'=>$bookings,

                'bookingCount'=>count($bookings),

                'packageCount'=>count(
                    require APP_PATH . '/data/packages.php'
                ),

                'destinationCount'=>count(
                    require APP_PATH . '/data/destinations.php'
                )

            ]

        );


    }


}
