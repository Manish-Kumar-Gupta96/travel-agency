<?php

namespace App\Middleware;


use Exception;



class LoggingMiddleware
{


    protected string $logPath;





    public function __construct()
    {

        $this->logPath =

            __DIR__ .

            '/../../storage/logs/';


    }





    /**
     * Handle Logging
     */
    public function handle(
        array $request,
        callable $next
    )
    {


        $startTime = microtime(true);


        $requestId = $this->generateRequestId();





        try
        {


            $this->logRequest(

                $request,

                $requestId

            );





            $response =

                $next(

                    $request

                );





            $executionTime =

                microtime(true)

                -

                $startTime;





            $this->logResponse(

                $response,

                $requestId,

                $executionTime

            );





            return $response;


        }
        catch(Exception $e)
        {


            $this->logError(

                $e,

                $requestId

            );





            return [

                'status' => false,

                'code' => 500,

                'message' => 'Internal Server Error'

            ];


        }


    }





    /**
     * Log Incoming Request
     */
    protected function logRequest(
        array $request,
        string $requestId
    ): void
    {


        $this->write(

            'requests.log',

            [

                'request_id' => $requestId,

                'method' =>

                    $request['method']
                    ??
                    'UNKNOWN',

                'url' =>

                    $request['url']
                    ??
                    null,

                'ip' =>

                    $request['ip']
                    ??
                    null,

                'user_id' =>

                    $request['user']['id']
                    ??
                    null,

                'time' => date('Y-m-d H:i:s')

            ]

        );


    }





    /**
     * Log Response
     */
    protected function logResponse(
        array $response,
        string $requestId,
        float $executionTime
    ): void
    {


        $this->write(

            'responses.log',

            [

                'request_id' => $requestId,

                'status' =>

                    $response['status']
                    ??
                    null,

                'execution_time' =>

                    round(

                        $executionTime,

                        4

                    ),

                'time' => date('Y-m-d H:i:s')

            ]

        );


    }





    /**
     * Log Errors
     */
    protected function logError(
        Exception $exception,
        string $requestId
    ): void
    {


        $this->write(

            'errors.log',

            [

                'request_id' => $requestId,

                'message' =>

                    $exception->getMessage(),

                'file' =>

                    $exception->getFile(),

                'line' =>

                    $exception->getLine(),

                'time' => date('Y-m-d H:i:s')

            ]

        );


    }





    /**
     * User Activity Log
     */
    public function activity(
        array $data
    ): void
    {


        $this->write(

            'activity.log',

            [

                'user_id' =>

                    $data['user_id']
                    ??
                    null,

                'action' =>

                    $data['action']
                    ??
                    null,

                'module' =>

                    $data['module']
                    ??
                    null,

                'time' => date('Y-m-d H:i:s')

            ]

        );


    }





    /**
     * Generate Request ID
     */
    protected function generateRequestId(): string
    {

        return uniqid(

            'REQ_',

            true

        );


    }





    /**
     * Write Log
     */
    protected function write(
        string $file,
        array $data
    ): void
    {


        if(
            !is_dir(
                $this->logPath
            )
        )
        {

            mkdir(

                $this->logPath,

                0777,

                true

            );

        }





        file_put_contents(

            $this->logPath . $file,

            json_encode(

                $data

            )
            .
            PHP_EOL,

            FILE_APPEND

        );


    }





}
