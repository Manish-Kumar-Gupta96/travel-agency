<?php

declare(strict_types=1);


namespace App\Api;



class ResourceTransformer
{


    public static function collection(
        array $items
    ): array
    {


        return array_map(

            function($item){

                return self::transform($item);

            },

            $items

        );


    }





    public static function transform(
        array $item
    ): array
    {


        return [

            'id'=>$item['id'] ?? null,

            'name'=>
            $item['name']
            ??
            $item['title']
            ??
            null,

            'image'=>
            $item['image']
            ??
            null,

            'created_at'=>
            $item['created_at']
            ??
            null

        ];


    }


}
