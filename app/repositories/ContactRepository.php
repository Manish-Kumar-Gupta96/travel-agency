<?php

declare(strict_types=1);


namespace App\Repositories;


use App\Models\Contact;



class ContactRepository
{


    private Contact $contact;



    public function __construct()
    {

        $this->contact = new Contact();

    }





    public function save(array $data)
    {


        return $this->contact->createMessage($data);


    }





    public function all()
    {


        return $this->contact->all();


    }





    public function changeStatus(
        int $id,
        string $status
    )
    {


        return $this->contact->updateStatus(

            $id,

            $status

        );


    }


}
