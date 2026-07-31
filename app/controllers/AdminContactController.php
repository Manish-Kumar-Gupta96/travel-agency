<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;
use App\Repositories\ContactRepository;



class AdminContactController extends Controller
{


    private ContactRepository $repository;



    public function __construct()
    {

        $this->repository = new ContactRepository();

    }





    public function index()
    {


        $contacts = $this->repository->all();



        return $this->view(

            'admin/contacts/index',

            [

                'title'=>'Contact Messages',

                'contacts'=>$contacts

            ]

        );


    }





    public function updateStatus()
    {


        $id = (int)($_POST['id'] ?? 0);


        $status = $_POST['status'] ?? 'new';



        $this->repository->changeStatus(

            $id,

            $status

        );



        return $this->redirect(

            '/admin/contacts'

        );


    }


}
