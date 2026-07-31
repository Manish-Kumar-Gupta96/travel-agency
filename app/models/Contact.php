<?php

declare(strict_types=1);


namespace App\Models;


use App\Core\Model;



class Contact extends Model
{


    protected string $table = 'contacts';




    public function createMessage(array $data)
    {


        return $this->insert(

            [

                'name'=>$data['name'],

                'email'=>$data['email'],

                'message'=>$data['message']

            ]

        );


    }





    public function updateStatus(
        int $id,
        string $status
    )
    {


        return $this->update(

            $id,

            [

                'status'=>$status

            ]

        );


    }


}
