<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;
use App\Models\Booking;



class AdminBookingStatusController extends Controller
{


    private Booking $booking;



    public function __construct()
    {

        $this->booking = new Booking();

    }




    public function update()
    {


        $id = (int)($_POST['id'] ?? 0);


        $status = $_POST['status'] ?? 'pending';



        $allowed = [

            'pending',

            'confirmed',

            'cancelled'

        ];



        if(!in_array($status,$allowed,true)){

            $status = 'pending';

        }



        $this->booking->update(

            $id,

            [

                'status'=>$status

            ]

        );



        return $this->redirect(
            '/admin/bookings'
        );


    }


}
