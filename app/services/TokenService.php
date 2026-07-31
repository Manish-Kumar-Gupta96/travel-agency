<?php

declare(strict_types=1);


namespace App\Services;



class TokenService
{


    public function generate(
        int $userId
    ): string
    {


        $payload = [

            'user_id'=>$userId,

            'created'=>time(),

            'expire'=>time()+86400

        ];



        return base64_encode(

            json_encode($payload)

        );


    }





    public function validate(
        string $token
    ): bool
    {


        $data = json_decode(

            base64_decode($token),

            true

        );



        if(!$data){

            return false;

        }



        return $data['expire'] > time();


    }


}
