<?php

namespace App\Middleware;


class SecurityHeadersMiddleware
{


    protected array $headers = [];





    public function __construct()
    {

        $this->headers = [

            'X-Content-Type-Options' => 'nosniff',

            'X-Frame-Options' => 'DENY',

            'X-XSS-Protection' => '1; mode=block',

            'Referrer-Policy' => 'strict-origin-when-cross-origin',

            'Permissions-Policy' =>

                'geolocation=(), microphone=(), camera=()',

            'Content-Security-Policy' =>

                "default-src 'self'",

            'Strict-Transport-Security' =>

                'max-age=31536000; includeSubDomains'


        ];

    }





    /**
     * Handle Security Headers
     */
    public function handle(
        array $request,
        callable $next
    )
    {


        $response =

            $next(

                $request

            );





        return $this->addHeaders(

            $response

        );


    }





    /**
     * Add Headers To Response
     */
    protected function addHeaders(
        array $response
    ): array
    {


        if(
            !isset(
                $response['headers']
            )
        )
        {

            $response['headers'] = [];

        }





        foreach(
            $this->headers as $key => $value
        )
        {

            $response['headers'][$key] = $value;

        }





        return $response;


    }





    /**
     * Add Custom Header
     */
    public function add(
        string $name,
        string $value
    ): void
    {


        $this->headers[$name] = $value;


    }





    /**
     * Remove Header
     */
    public function remove(
        string $name
    ): void
    {


        unset(

            $this->headers[$name]

        );


    }





    /**
     * Get Headers
     */
    public function getHeaders(): array
    {

        return $this->headers;

    }





}
