<?php

namespace App\Core\Mail;



use InvalidArgumentException;



class MailManager
{


    protected array $drivers = [];



    protected string $default = 'smtp';





    public function __construct(
        array $config = []
    )
    {


        $this->default =
            $config['default']
            ??
            'smtp';



        $this->registerDrivers(

            $config

        );

    }





    /**
     * Register Mail Drivers
     */
    protected function registerDrivers(
        array $config
    ): void
    {


        $drivers =
            $config['drivers']
            ??
            [];



        foreach(
            $drivers as $name => $driver
        )
        {

            $this->drivers[$name] =
                $driver;

        }

    }





    /**
     * Add Mail Driver
     */
    public function add(
        string $name,
        Mailer $mailer
    ): static
    {

        $this->drivers[$name] =
            $mailer;


        return $this;

    }





    /**
     * Get Mail Driver
     */
    public function driver(
        ?string $name = null
    ): Mailer
    {


        $name =
            $name
            ??
            $this->default;



        if(
            !isset(

                $this->drivers[$name]

            )
        )
        {


            throw new InvalidArgumentException(

                "Mail driver {$name} not found"

            );

        }



        return $this->drivers[$name];

    }





    /**
     * Send Mail
     */
    public function send(
        string $to,
        string $subject,
        string $body,
        array $attachments = []
    ): bool
    {

        return $this->driver()

            ->send(

                $to,

                $subject,

                $body,

                $attachments

            );

    }





    /**
     * Set Default Driver
     */
    public function setDefault(
        string $name
    ): void
    {

        $this->default = $name;

    }





    /**
     * Get Default Driver
     */
    public function getDefault(): string
    {

        return $this->default;

    }





    /**
     * Set Sender
     */
    public function from(
        string $email,
        string $name = ''
    ): static
    {

        $this->driver()

            ->from(

                $email,

                $name

            );


        return $this;

    }





    /**
     * Add CC
     */
    public function cc(
        string $email
    ): static
    {

        $this->driver()

            ->cc(

                $email

            );


        return $this;

    }





    /**
     * Add BCC
     */
    public function bcc(
        string $email
    ): static
    {

        $this->driver()

            ->bcc(

                $email

            );


        return $this;

    }





    /**
     * Add Attachment
     */
    public function attach(
        string $path
    ): static
    {

        $this->driver()

            ->attach(

                $path

            );


        return $this;

    }





    /**
     * Driver List
     */
    public function drivers(): array
    {

        return array_keys(

            $this->drivers

        );

    }





    /**
     * Check Driver
     */
    public function hasDriver(
        string $name
    ): bool
    {

        return isset(

            $this->drivers[$name]

        );

    }





    /**
     * Remove Driver
     */
    public function remove(
        string $name
    ): void
    {

        unset(

            $this->drivers[$name]

        );

    }





    /**
     * Magic Driver Access
     */
    public function __call(
        string $method,
        array $arguments
    ): mixed
    {

        return $this->driver()

            ->$method(

                ...$arguments

            );

    }


}
