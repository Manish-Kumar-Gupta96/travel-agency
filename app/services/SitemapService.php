<?php

declare(strict_types=1);


namespace App\Services;



class SitemapService
{


    private array $urls = [];




    public function add(
        string $url
    ): void
    {


        $this->urls[] = $url;


    }





    public function generate(): string
    {


        $xml = '<?xml version="1.0" encoding="UTF-8"?>';


        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';



        foreach($this->urls as $url){


            $xml .= '<url>';

            $xml .= '<loc>'
                . htmlspecialchars($url)
                . '</loc>';

            $xml .= '</url>';


        }



        $xml .= '</urlset>';



        return $xml;


    }


}
