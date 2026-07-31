<?php

declare(strict_types=1);


namespace App\Middleware;


use App\Services\SeoService;



class SeoMiddleware
{


    private SeoService $seo;



    public function __construct()
    {

        $this->seo = new SeoService();

    }





    public function handle(
        array $routeData = []
    )
    {


        $this->seo

            ->setTitle(
                $routeData['title']
                ??
                'Premium Travel Experience'
            )

            ->setDescription(
                $routeData['description']
                ??
                'Explore premium destinations and travel packages.'
            );



        return $this->seo->getMeta();


    }


}
