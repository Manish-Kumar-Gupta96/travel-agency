<?php

declare(strict_types=1);


namespace App\Services;



class AssetService
{


    public function version(
        string $file
    ): string
    {


        $path =
        PUBLIC_PATH . $file;



        if(file_exists($path)){


            return $file .
            '?v=' .
            filemtime($path);


        }



        return $file;


    }





    public function css(
        string $file
    ): string
    {


        return '<link rel="stylesheet" href="' .
        $this->version($file) .
        '">';


    }





    public function js(
        string $file
    ): string
    {


        return '<script src="' .
        $this->version($file) .
        '"></script>';


    }


}
