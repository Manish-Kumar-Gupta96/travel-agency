<?php

namespace App\Middleware;


use Exception;



class RateLimitMiddleware
{


    protected int $maxRequests;


    protected int $timeWindow;


    protected string $storagePath;





    public function __construct(
        int $maxRequests = 100,
        int $timeWindow = 60
    )
    {

        $this->maxRequests = $maxRequests;

        $this->timeWindow = $timeWindow;


        $this->storagePath =

            __DIR__ .
            '/../../storage/rate-limit/';


    }





    /**
     * Handle Rate Limit
     */
    public function handle(
        array $request,
        callable $next
    )
    {


        try
        {


            $identifier =

                $this->getIdentifier(

                    $request

                );





            if(
                !$this->allowed(

                    $identifier

                )
            )
            {

                throw new Exception(

                    "Too many requests. Please try again later"

                );

            }





            return $next(

                $request

            );


        }
        catch(Exception $e)
        {


            return [

                'status' => false,

                'code' => 429,

                'message' => $e->getMessage()

            ];


        }


    }





    /**
     * Check Request Allowed
     */
    protected function allowed(
        string $identifier
    ): bool
    {


        $file =

            $this->storagePath .

            md5(

                $identifier

            ) .

            '.json';





        $data =

            $this->read(

                $file

            );





        $currentTime = time();





        if(
            empty($data)
        )
        {

            $data = [

                'count' => 1,

                'start' => $currentTime

            ];

        }
        else
        {


            if(
                ($currentTime - $data['start'])
                >
                $this->timeWindow
            )
            {

                $data = [

                    'count' => 1,

                    'start' => $currentTime

                ];

            }
            else
            {

                $data['count']++;

            }


        }





        $this->write(

            $file,

            $data

        );





        return (

            $data['count']

            <=

            $this->maxRequests

        );


    }





    /**
     * Generate Identifier
     */
    protected function getIdentifier(
        array $request
    ): string
    {


        if(
            isset(
                $request['user']['id']
            )
        )
        {

            return 'user_' .
                $request['user']['id'];

        }





        return 'ip_' .
            (

                $request['ip']
                ??
                'unknown'

            );


    }





    /**
     * Read Storage
     */
    protected function read(
        string $file
    ): array
    {


        if(
            !file_exists($file)
        )
        {

            return [];

        }





        return json_decode(

            file_get_contents($file),

            true

        )
        ??
        [];


    }





    /**
     * Write Storage
     */
    protected function write(
        string $file,
        array $data
    ): void
    {


        if(
            !is_dir(
                $this->storagePath
            )
        )
        {

            mkdir(

                $this->storagePath,

                0777,

                true

            );

        }





        file_put_contents(

            $file,

            json_encode(

                $data

            )

        );


    }





    /**
     * Reset Limit
     */
    public function reset(
        string $identifier
    ): void
    {


        $file =

            $this->storagePath .

            md5(

                $identifier

            ) .

            '.json';





        if(
            file_exists($file)
        )
        {

            unlink(

                $file

            );

        }


    }





    /**
     * Remaining Requests
     */
    public function remaining(
        string $identifier
    ): int
    {


        $file =

            $this->storagePath .

            md5(

                $identifier

            ) .

            '.json';





        $data =

            $this->read(

                $file

            );





        if(
            empty($data)
        )
        {

            return $this->maxRequests;

        }





        return max(

            0,

            $this->maxRequests -

            $data['count']

        );


    }





}
