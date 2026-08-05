<?php

namespace App\Core\Scheduler;



use DateTime;



class Schedule
{


    protected array $tasks = [];





    /**
     * Add Task
     */
    public function add(
        Task $task
    ): static
    {

        $this->tasks[] =
            $task;


        return $this;

    }





    /**
     * Get Tasks
     */
    public function tasks(): array
    {

        return $this->tasks;

    }





    /**
     * Run Due Tasks
     */
    public function dueTasks(): array
    {


        return array_filter(

            $this->tasks,

            function(Task $task)
            {

                return $task->isDue();

            }

        );

    }





    /**
     * Daily Schedule
     */
    public function daily(
        callable $callback,
        string $time = '00:00'
    ): Task
    {


        $task =
            new Task(

                $callback

            );



        $task->daily(

            $time

        );



        $this->add(

            $task

        );



        return $task;

    }





    /**
     * Hourly Schedule
     */
    public function hourly(
        callable $callback
    ): Task
    {


        $task =
            new Task(

                $callback

            );



        $task->hourly();



        $this->add(

            $task

        );



        return $task;

    }





    /**
     * Weekly Schedule
     */
    public function weekly(
        callable $callback,
        string $day = 'monday'
    ): Task
    {


        $task =
            new Task(

                $callback

            );



        $task->weekly(

            $day

        );



        $this->add(

            $task

        );



        return $task;

    }





    /**
     * Monthly Schedule
     */
    public function monthly(
        callable $callback,
        int $day = 1
    ): Task
    {


        $task =
            new Task(

                $callback

            );



        $task->monthly(

            $day

        );



        $this->add(

            $task

        );



        return $task;

    }





    /**
     * Custom Cron Schedule
     */
    public function cron(
        callable $callback,
        string $expression
    ): Task
    {


        $task =
            new Task(

                $callback

            );



        $task->cron(

            $expression

        );



        $this->add(

            $task

        );



        return $task;

    }





    /**
     * Remove Task
     */
    public function remove(
        Task $task
    ): static
    {


        foreach(
            $this->tasks as $key => $item
        )
        {


            if(
                $item === $task
            )
            {

                unset(

                    $this->tasks[$key]

                );

            }


        }



        return $this;

    }





    /**
     * Clear All Tasks
     */
    public function clear(): static
    {

        $this->tasks = [];


        return $this;

    }





    /**
     * Count Tasks
     */
    public function count(): int
    {

        return count(

            $this->tasks

        );

    }





}
