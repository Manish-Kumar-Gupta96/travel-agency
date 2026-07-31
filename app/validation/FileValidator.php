<?php

declare(strict_types=1);


namespace App\Validation;



class FileValidator
{


    private array $allowedTypes = [

        'image/jpeg',

        'image/png',

        'image/webp'

    ];



    private int $maxSize = 5242880;





    public function validate(array $file): array
    {


        $errors = [];



        if(
            !in_array(
                $file['type'] ?? '',
                $this->allowedTypes,
                true
            )
        ){

            $errors[] =
            'Invalid file type';

        }




        if(
            ($file['size'] ?? 0)
            >
            $this->maxSize
        ){

            $errors[] =
            'File size exceeded';

        }




        return $errors;


    }


}
