<?php

declare(strict_types=1);


namespace App\Middleware;



class AdminMiddleware
{


    public function handle()
    {


        if(!isset($_SESSION['user'])){


            header(
                'Location: /login'
            );


            exit;

        }




        if(
            $_SESSION['user']['role'] !== 'admin'
        ){


            http_response_code(403);


            exit(
                'Access Denied'
            );


        }



        return true;


    }


}
