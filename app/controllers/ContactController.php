<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;



class ContactController extends Controller
{


    public function index()
    {


        return $this->view(

            'pages/contact/index',

            [

                'title'=>'Contact Us'

            ]

        );


    }





    public function send()
    {


        $contact = [

            'name'=>trim($_POST['name'] ?? ''),

            'email'=>trim($_POST['email'] ?? ''),

            'message'=>trim($_POST['message'] ?? '')

        ];



        /*
            Save contact message
            Email notification service
            will be connected later
        */



        return $this->view(

            'pages/contact/success',

            [

                'title'=>'Message Sent',

                'contact'=>$contact

            ]

        );


    }


}
