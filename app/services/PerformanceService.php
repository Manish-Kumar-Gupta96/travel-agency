<?php

declare(strict_types=1);


namespace App\Services;



class PerformanceService
{


    public function enableCompression(): void
    {


        if(
            !ob_start(
                'ob_gzhandler'
            )
        ){

            ob_start();

        }


    }





    public function addCacheHeaders(): void
    {


        header(

            'Cache-Control: public, max-age=3600'

        );


    }





    public function optimizeResponse(): void
    {


        $this->enableCompression();


        $this->addCacheHeaders();


    }


}
