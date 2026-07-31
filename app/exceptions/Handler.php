<?php

declare(strict_types=1);


namespace App\Exceptions;



use Throwable;



class Handler
{


    public function register(): void
    {


        set_exception_handler(

            [$this,'handle']

        );


    }





    public function handle(
        Throwable $exception
    ): void
    {


        http_response_code(500);



        if(
            getenv('APP_ENV')
            ===
            'production'
        ){

            require APP_PATH .
            '/views/errors/500.php';


        }else{


            echo '<pre>';

            echo $exception;

            echo '</pre>';


        }



    }


}
