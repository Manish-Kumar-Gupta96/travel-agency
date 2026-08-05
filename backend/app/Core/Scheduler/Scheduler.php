<?php

namespace App\Core\Scheduler;



use Throwable;



class Scheduler
{


    protected Schedule $schedule;



    protected array $logs = [];





    public function __construct(
        Schedule $schedule
    )
    {

        $this->schedule =
            $schedule;

    }





    /**
     * Run Scheduler
     */
    public function run(): array
    {


        $tasks =
            $this->schedule
                ->dueTasks();



        foreach(
            $tasks as $task
        )
        {

            $this->execute(

                $task

            );

        }



        return $this->logs;

    }





    /**
     * Execute Task
     */
    protected function execute(
        Task $task
    ): void
    {


        try
        {


            $start =
                microtime(true);



            $result =
                $task->run();



            $time =
                microtime(true)
                -
                $start;



            $this->logs[] = [

                'status' =>
                    'success',

                'time' =>
                    $time,

                'result' =>
                    $result,

                'task' =>
                    $task->toArray()

            ];

        }
        catch(
            Throwable $exception
        )
        {


            $this->logs[] = [

                'status' =>
                    'failed',

                'error' =>
                    $exception->getMessage(),

                'task' =>
                    $task->toArray()

            ];

        }

    }





    /**
     * Get Schedule
     */
    public function schedule(): Schedule
    {

        return $this->schedule;

    }





    /**
     * Run Single Task
     */
    public function runTask(
        Task $task
    ): array
    {


        $this->execute(

            $task

        );



        return end(

            $this->logs

        );

    }





    /**
     * Get Execution Logs
     */
    public function logs(): array
    {

        return $this->logs;

    }





    /**
     * Last Execution Log
     */
    public function lastLog(): ?array
    {


        if(empty($this->logs))
        {

            return null;

        }



        return end(

            $this->logs

        );

    }





    /**
     * Count Executions
     */
    public function count(): int
    {

        return count(

            $this->logs

        );

    }





    /**
     * Clear Logs
     */
    public function clearLogs(): static
    {

        $this->logs = [];


        return $this;

    }





    /**
     * Check Pending Tasks
     */
    public function pending(): array
    {

        return $this->schedule

            ->dueTasks();

    }





    /**
     * Start Scheduler Loop
     */
    public function daemon(
        int $interval = 60
    ): void
    {


        while(true)
        {


            $this->run();



            sleep(

                $interval

            );


        }

    }





    /**
     * Scheduler Status
     */
    public function status(): array
    {


        return [

            'tasks' =>
                $this->schedule->count(),

            'executions' =>
                $this->count(),

            'running' =>
                true

        ];

    }





    /**
     * Get Due Task Count
     */
    public function dueCount(): int
    {

        return count(

            $this->schedule
                ->dueTasks()

        );

    }





    /**
     * Execute And Return Report
     */
    public function report(): array
    {


        return [

            'status' =>
                $this->status(),

            'logs' =>
                $this->logs

        ];

    }





}
