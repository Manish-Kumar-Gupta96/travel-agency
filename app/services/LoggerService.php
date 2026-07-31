<?php

declare(strict_types=1);


namespace App\Services;



class LoggerService
{


    private string $file;



    public function __construct()
    {

        $this->file =
        STORAGE_PATH .
        '/logs/app.log';

    }





    public function info(
        string $message
    ): void
    {


        $this->write(
            'INFO',
            $message
        );


    }





    public function error(
        string $message
    ): void
    {


        $this->write(
            'ERROR',
            $message
        );


    }





    private function write(
        string $level,
        string $message
    ): void
    {


        $line =
        date('Y-m-d H:i:s')
        .
        " [$level] "
        .
        $message
        .
        PHP_EOL;



        file_put_contents(

            $this->file,

            $line,

            FILE_APPEND

        );


    }


}
