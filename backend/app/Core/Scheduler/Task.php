<?php

namespace App\Core\Scheduler;



use DateTime;



class Task
{


    protected $callback;



    protected string $frequency = 'daily';



    protected ?string $time = null;



    protected ?string $day = null;



    protected ?int $date = null;



    protected ?string $cron = null;



    protected bool $active = true;





    public function __construct(
        callable $callback
    )
    {

        $this->callback = $callback;

    }





    /**
     * Execute Task
     */
    public function run(): mixed
    {

        return call_user_func(

            $this->callback

        );

    }





    /**
     * Daily Frequency
     */
    public function daily(
        string $time = '00:00'
    ): static
    {

        $this->frequency = 'daily';


        $this->time = $time;


        return $this;

    }





    /**
     * Hourly Frequency
     */
    public function hourly(): static
    {

        $this->frequency = 'hourly';


        return $this;

    }





    /**
     * Weekly Frequency
     */
    public function weekly(
        string $day = 'monday'
    ): static
    {

        $this->frequency = 'weekly';


        $this->day = $day;


        return $this;

    }





    /**
     * Monthly Frequency
     */
    public function monthly(
        int $day = 1
    ): static
    {

        $this->frequency = 'monthly';


        $this->date = $day;


        return $this;

    }





    /**
     * Cron Expression
     */
    public function cron(
        string $expression
    ): static
    {

        $this->frequency = 'cron';


        $this->cron = $expression;


        return $this;

    }





    /**
     * Check Task Due
     */
    public function isDue(): bool
    {


        if(!$this->active)
        {

            return false;

        }



        $now =
            new DateTime();



        switch(
            $this->frequency
        )
        {


            case 'hourly':

                return true;



            case 'daily':

                return $this->checkDaily(

                    $now

                );



            case 'weekly':

                return $this->checkWeekly(

                    $now

                );



            case 'monthly':

                return $this->checkMonthly(

                    $now

                );



            case 'cron':

                return $this->checkCron(

                    $now

                );


        }



        return false;

    }





    /**
     * Daily Check
     */
    protected function checkDaily(
        DateTime $now
    ): bool
    {


        if(!$this->time)
        {

            return true;

        }



        return $now->format('H:i')
            ===
            $this->time;

    }





    /**
     * Weekly Check
     */
    protected function checkWeekly(
        DateTime $now
    ): bool
    {


        return strtolower(

            $now->format('l')

        )
        ===
        strtolower(

            $this->day

        );

    }





    /**
     * Monthly Check
     */
    protected function checkMonthly(
        DateTime $now
    ): bool
    {


        return (int)$now->format('d')
            ===
            $this->date;

    }





    /**
     * Cron Check
     */
    protected function checkCron(
        DateTime $now
    ): bool
    {


        return !empty(

            $this->cron

        );

    }





    /**
     * Enable Task
     */
    public function enable(): static
    {

        $this->active = true;


        return $this;

    }





    /**
     * Disable Task
     */
    public function disable(): static
    {

        $this->active = false;


        return $this;

    }





    /**
     * Task Status
     */
    public function active(): bool
    {

        return $this->active;

    }





    /**
     * Get Frequency
     */
    public function frequency(): string
    {

        return $this->frequency;

    }





    /**
     * Get Time
     */
    public function time(): ?string
    {

        return $this->time;

    }





    /**
     * Get Cron Expression
     */
    public function expression(): ?string
    {

        return $this->cron;

    }





    /**
     * Task Information
     */
    public function toArray(): array
    {

        return [

            'frequency' =>
                $this->frequency,

            'time' =>
                $this->time,

            'day' =>
                $this->day,

            'date' =>
                $this->date,

            'cron' =>
                $this->cron,

            'active' =>
                $this->active

        ];

    }





}
