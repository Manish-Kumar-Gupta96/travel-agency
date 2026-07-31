<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;



class AdminPackageController extends Controller
{


    public function index()
    {


        $packages = require APP_PATH . '/data/packages.php';



        return $this->view(

            'admin/packages/index',

            [

                'title'=>'Manage Packages',

                'packages'=>$packages

            ]

        );


    }





    public function create()
    {


        return $this->view(

            'admin/packages/create',

            [

                'title'=>'Create Package'

            ]

        );


    }





    public function store()
    {


        $data = [

            'title'=>trim($_POST['title'] ?? ''),

            'destination'=>trim($_POST['destination'] ?? ''),

            'price'=>trim($_POST['price'] ?? ''),

            'duration'=>trim($_POST['duration'] ?? '')

        ];



        // Database insert service will handle storage



        return $this->redirect(
            '/admin/packages'
        );


    }


}
