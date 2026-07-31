<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;



class AdminDestinationController extends Controller
{


    public function index()
    {


        $destinations = require APP_PATH . '/data/destinations.php';



        return $this->view(

            'admin/destinations/index',

            [

                'title'=>'Manage Destinations',

                'destinations'=>$destinations

            ]

        );


    }





    public function create()
    {


        return $this->view(

            'admin/destinations/create',

            [

                'title'=>'Create Destination'

            ]

        );


    }





    public function store()
    {


        $destination = [

            'name'=>trim($_POST['name'] ?? ''),

            'country'=>trim($_POST['country'] ?? ''),

            'description'=>trim($_POST['description'] ?? '')

        ];



        // Destination storage service



        return $this->redirect(
            '/admin/destinations'
        );


    }


}
