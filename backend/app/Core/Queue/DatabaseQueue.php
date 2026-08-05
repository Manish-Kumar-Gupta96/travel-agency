<?php

namespace App\Core\Queue;



use PDO;

use Throwable;



class DatabaseQueue implements Queue
{


    protected PDO $db;



    protected string $table = 'jobs';





    public function __construct(
        PDO $db,
        string $table = 'jobs'
    )
    {

        $this->db = $db;


        $this->table = $table;

    }





    /**
     * Push Job
     */
    public function push(
        Job $job
    ): string
    {


        $id =
            $job->id();



        $sql = "
            INSERT INTO {$this->table}
            (
                id,
                queue,
                payload,
                attempts,
                available_at,
                created_at
            )
            VALUES
            (
                :id,
                :queue,
                :payload,
                :attempts,
                :available,
                :created
            )
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        $stmt->execute([

            'id' =>
                $id,

            'queue' =>
                $job->queue(),

            'payload' =>
                $job->serialize(),

            'attempts' =>
                0,

            'available' =>
                time()
                +
                $job->getDelay(),

            'created' =>
                time()

        ]);



        return $id;

    }





    /**
     * Pop Job
     */
    public function pop(
        string $queue = 'default'
    ): ?Job
    {


        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE queue = :queue
            AND available_at <= :time
            ORDER BY id ASC
            LIMIT 1
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        $stmt->execute([

            'queue' =>
                $queue,

            'time' =>
                time()

        ]);



        $job =
            $stmt->fetch(

                PDO::FETCH_ASSOC

            );



        if(!$job)
        {

            return null;

        }



        return Job::restore(

            $job['payload']

        );

    }





    /**
     * Delete Completed Job
     */
    public function delete(
        string $id
    ): bool
    {


        $sql = "
            DELETE FROM {$this->table}
            WHERE id = :id
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        return $stmt->execute([

            'id' =>
                $id

        ]);

    }





    /**
     * Release Job Back To Queue
     */
    public function release(
        Job $job,
        int $delay = 0
    ): bool
    {


        $sql = "
            UPDATE {$this->table}
            SET
                attempts = attempts + 1,
                available_at = :available
            WHERE id = :id
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        return $stmt->execute([

            'available' =>
                time()
                +
                $delay,

            'id' =>
                $job->id()

        ]);

    }





    /**
     * Failed Job
     */
    public function failed(
        Job $job,
        Throwable $exception
    ): bool
    {


        $sql = "
            INSERT INTO failed_jobs
            (
                job_id,
                payload,
                error,
                failed_at
            )
            VALUES
            (
                :id,
                :payload,
                :error,
                :time
            )
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        return $stmt->execute([

            'id' =>
                $job->id(),

            'payload' =>
                $job->serialize(),

            'error' =>
                $exception->getMessage(),

            'time' =>
                time()

        ]);

    }





    /**
     * Queue Size
     */
    public function size(
        string $queue = 'default'
    ): int
    {


        $sql = "
            SELECT COUNT(*)
            FROM {$this->table}
            WHERE queue = :queue
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        $stmt->execute([

            'queue' =>
                $queue

        ]);



        return (int)
            $stmt->fetchColumn();

    }





    /**
     * Clear Queue
     */
    public function clear(
        string $queue = 'default'
    ): bool
    {


        $sql = "
            DELETE FROM {$this->table}
            WHERE queue = :queue
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        return $stmt->execute([

            'queue' =>
                $queue

        ]);

    }





    /**
     * Get Pending Jobs
     */
    public function pending(
        string $queue = 'default'
    ): array
    {


        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE queue = :queue
            ORDER BY created_at DESC
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        $stmt->execute([

            'queue' =>
                $queue

        ]);



        return $stmt->fetchAll(

            PDO::FETCH_ASSOC

        );

    }





    /**
     * Get Failed Jobs
     */
    public function failedJobs(): array
    {


        $stmt =
            $this->db->query(

                "
                SELECT *
                FROM failed_jobs
                ORDER BY failed_at DESC
                "

            );



        return $stmt->fetchAll(

            PDO::FETCH_ASSOC

        );

    }





    /**
     * Retry Failed Job
     */
    public function retryFailed(
        int $id
    ): bool
    {


        $sql = "
            SELECT payload
            FROM failed_jobs
            WHERE id = :id
        ";



        $stmt =
            $this->db->prepare(

                $sql

            );



        $stmt->execute([

            'id' =>
                $id

        ]);



        $job =
            $stmt->fetchColumn();



        if(!$job)
        {

            return false;

        }



        $restored =
            Job::restore(

                $job

            );



        $this->push(

            $restored

        );



        $delete =
            $this->db->prepare(

                "
                DELETE FROM failed_jobs
                WHERE id = :id
                "

            );



        return $delete->execute([

            'id' =>
                $id

        ]);

    }





    /**
     * Get Table Name
     */
    public function table(): string
    {

        return $this->table;

    }


}
