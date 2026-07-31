<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;
use App\Models\User;



class AdminUserController extends Controller
{


    private User $user;



    public function __construct()
    {

        $this->user = new User();

    }





    public function index()
    {


        $users = $this->user->all();



        return $this->view(

            'admin/users/index',

            [

                'title'=>'Manage Users',

                'users'=>$users

            ]

        );


    }




    public function updateRole()
    {


        $id = (int)($_POST['id'] ?? 0);


        $role = $_POST['role'] ?? 'customer';



        $this->user->update(

            $id,

            [

                'role'=>$role

            ]

        );



        return $this->redirect(
            '/admin/users'
        );


    }


}
