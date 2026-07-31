<?php

declare(strict_types=1);


namespace App\Models;


use App\Core\Model;



class Media extends Model
{


    protected string $table = 'media';




    public function saveImage(array $data)
    {


        return $this->insert(

            [

                'file_name'=>$data['file_name'],

                'file_path'=>$data['file_path'],

                'type'=>$data['type']

            ]

        );


    }



    public function getImages()
    {


        return $this->all();


    }


}
