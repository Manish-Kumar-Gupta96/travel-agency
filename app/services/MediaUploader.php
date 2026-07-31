<?php

declare(strict_types=1);


namespace App\Services;



class MediaUploader
{


    private string $path =
    PUBLIC_PATH . '/uploads/';



    public function upload(array $file): ?string
    {


        if(
            !isset($file['tmp_name'])
        ){

            return null;

        }



        $extension = pathinfo(

            $file['name'],

            PATHINFO_EXTENSION

        );



        $filename =
        uniqid('media_', true)
        . '.'
        . $extension;




        move_uploaded_file(

            $file['tmp_name'],

            $this->path . $filename

        );



        return '/uploads/' . $filename;


    }


}
