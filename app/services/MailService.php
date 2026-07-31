<?php

declare(strict_types=1);


namespace App\Services;



class MailService
{


    public function send(

        string $to,

        string $subject,

        string $message

    ): bool
    {


        /*
            SMTP integration will be added
            with production mail provider.
        */


        return true;


    }





    public function sendBookingNotification(
        array $booking
    ): bool
    {


        return $this->send(

            'admin@example.com',

            'New Booking Request',

            json_encode($booking)

        );


    }





    public function sendContactNotification(
        array $contact
    ): bool
    {


        return $this->send(

            'admin@example.com',

            'New Contact Message',

            json_encode($contact)

        );


    }


}
