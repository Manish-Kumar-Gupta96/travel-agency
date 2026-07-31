<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Core\Controller;
use App\Models\User;



class AuthController extends Controller
{


    private User $user;



    public function __construct()
    {

        $this->user = new User();

    }





    public function login()
    {


        return $this->view(

            'auth/login',

            [

                'title'=>'Admin Login'

            ]

        );


    }





    public function authenticate()
    {


        $email = trim($_POST['email'] ?? '');

        $password = $_POST['password'] ?? '';



        $user = $this->user->findByEmail($email);



        if(
            !$user ||
            !password_verify(
                $password,
                $user['password']
            )
        ){


            return $this->view(

                'auth/login',

                [

                    'error'=>'Invalid login credentials'

                ]

            );


        }



        $_SESSION['user'] = [

            'id'=>$user['id'],

            'name'=>$user['name'],

            'role'=>$user['role']

        ];



        return $this->redirect('/admin/dashboard');


    }





    public function logout()
    {


        session_destroy();


        return $this->redirect('/login');


    }


}
