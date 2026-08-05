<?php

namespace App\Core\Mail\Drivers;



use App\Core\Mail\Mailer;

use Exception;



class SMTP implements Mailer
{


    protected string $host;



    protected int $port;



    protected string $username;



    protected string $password;



    protected string $encryption;



    protected array $headers = [];



    protected array $attachments = [];





    public function __construct(
        array $config = []
    )
    {


        $this->host =
            $config['host']
            ??
            'smtp.gmail.com';



        $this->port =
            $config['port']
            ??
            587;



        $this->username =
            $config['username']
            ??
            '';



        $this->password =
            $config['password']
            ??
            '';



        $this->encryption =
            $config['encryption']
            ??
            'tls';

    }





    /**
     * Send Email
     */
    public function send(
        string $to,
        string $subject,
        string $body,
        array $attachments = []
    ): bool
    {


        $headers =
            $this->buildHeaders();



        $result =
            mail(

                $to,

                $subject,

                $body,

                $headers

            );



        if(!$result)
        {

            throw new Exception(

                'Email sending failed'

            );

        }



        return true;

    }





    /**
     * Set Sender
     */
    public function from(
        string $email,
        string $name = ''
    ): static
    {


        $this->headers['From'] =
            $name
            ?
            "{$name} <{$email}>"
            :
            $email;



        return $this;

    }





    /**
     * Add CC
     */
    public function cc(
        string $email
    ): static
    {


        $this->headers['Cc'][] =
            $email;



        return $this;

    }





    /**
     * Add BCC
     */
    public function bcc(
        string $email
    ): static
    {


        $this->headers['Bcc'][] =
            $email;



        return $this;

    }





    /**
     * Add Attachment
     */
    public function attach(
        string $path
    ): static
    {


        $this->attachments[] =
            $path;



        return $this;

    }





    /**
     * Build Email Headers
     */
    protected function buildHeaders(): string
    {


        $headers = [];



        $headers[] =
            'MIME-Version: 1.0';



        $headers[] =
            'Content-Type: text/html; charset=UTF-8';



        foreach(
            $this->headers as $key => $value
        )
        {


            if(is_array($value))
            {


                foreach(
                    $value as $item
                )
                {

                    $headers[] =
                        $key . ': ' . $item;

                }


            }
            else
            {

                $headers[] =
                    $key . ': ' . $value;

            }


        }



        return implode(

            "\r\n",

            $headers

        );

    }





    /**
     * SMTP Config
     */
    public function config(): array
    {

        return [

            'host' =>
                $this->host,

            'port' =>
                $this->port,

            'username' =>
                $this->username,

            'encryption' =>
                $this->encryption

        ];

    }





    /**
     * Reset Mail Data
     */
    public function reset(): static
    {


        $this->headers = [];

        $this->attachments = [];



        return $this;

    }





    /**
     * Validate SMTP Configuration
     */
    public function validate(): bool
    {

        return !empty($this->host)

            &&
            !empty($this->port);

    }





    /**
     * Get Attachments
     */
    public function attachments(): array
    {

        return $this->attachments;

    }





    /**
     * Create Attachment Headers
     */
    protected function attachmentHeaders(): array
    {


        $result = [];



        foreach(
            $this->attachments as $file
        )
        {


            if(
                file_exists($file)
            )
            {


                $result[] = [

                    'file' =>
                        $file,

                    'size' =>
                        filesize($file)

                ];

            }


        }



        return $result;

    }





    /**
     * Get Mail Information
     */
    public function info(): array
    {

        return [

            'smtp' =>
                $this->config(),

            'headers' =>
                $this->headers,

            'attachments' =>
                $this->attachmentHeaders()

        ];

    }





}
