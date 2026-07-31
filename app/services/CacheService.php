<?php

declare(strict_types=1);


namespace App\Services;



class CacheService
{


    private string $path;



    public function __construct()
    {

        $this->path =
        STORAGE_PATH . '/cache/';

    }





    public function set(
        string $key,
        mixed $data,
        int $expire = 3600
    ): bool
    {


        $cache = [

            'expire'=>time() + $expire,

            'data'=>$data

        ];



        return file_put_contents(

            $this->path . md5($key) . '.cache',

            serialize($cache)

        ) !== false;


    }





    public function get(
        string $key
    ): mixed
    {


        $file =
        $this->path . md5($key) . '.cache';



        if(!file_exists($file)){

            return null;

        }



        $cache =
        unserialize(
            file_get_contents($file)
        );



        if(
            $cache['expire'] < time()
        ){

            unlink($file);


            return null;

        }



        return $cache['data'];


    }





    public function clear(): void
    {


        foreach(
            glob($this->path . '*.cache')
            as $file
        ){

            unlink($file);

        }


    }


}
