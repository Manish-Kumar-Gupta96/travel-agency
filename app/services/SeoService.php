<?php

declare(strict_types=1);


namespace App\Services;



class SeoService
{


    private array $meta = [];




    public function setTitle(
        string $title
    ): self
    {


        $this->meta['title'] = $title;


        return $this;


    }





    public function setDescription(
        string $description
    ): self
    {


        $this->meta['description'] = $description;


        return $this;


    }





    public function getMeta(): array
    {


        return $this->meta;


    }


}
