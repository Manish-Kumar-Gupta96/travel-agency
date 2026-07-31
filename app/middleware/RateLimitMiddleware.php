<?php

declare(strict_types=1);


namespace App\Middleware;



class RateLimitMiddleware
{


    private int $limit = 100;



    public function handle(): bool
    {


        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';


        $file =
        STORAGE_PATH .
        '/cache/rate_' .
        md5($ip);



        $count = 0;



        if(file_exists($file)){


            $data = json_decode(

                file_get_contents($file),

                true

            );


            $count = $data['count'] ?? 0;


        }



        if($count >= $this->limit){


            http_response_code(429);


            exit(
                json_encode(
                    [
                        'error'=>
                        'Too many requests'
                    ]
                )
            );


        }



        file_put_contents(

            $file,

            json_encode(

                [
                    'count'=>$count + 1,

                    'time'=>time()

                ]

            )

        );



        return true;


    }


}
