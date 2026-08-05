<?php

namespace App\Core\Mail;



interface Mailer
{


    /**
     * Send Email
     */
    public function send(
        string $to,
        string $subject,
        string $body,
        array $attachments = []
    ): bool;





    /**
     * Set Sender
     */
    public function from(
        string $email,
        string $name = ''
    ): static;





    /**
     * Add CC
     */
    public function cc(
        string $email
    ): static;





    /**
     * Add BCC
     */
    public function bcc(
        string $email
    ): static;





    /**
     * Add Attachment
     */
    public function attach(
        string $path
    ): static;


}
