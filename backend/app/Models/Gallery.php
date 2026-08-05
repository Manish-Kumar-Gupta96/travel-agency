<?php

namespace App\Models;

use App\Core\Database\Model;


class Gallery extends Model
{

    protected static string $table = 'gallery';


    protected array $fillable = [

        'title',

        'type',

        'url',

        'album_id',

        'status',

        'featured',

    ];





    /**
     * Active Gallery Items
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Featured Gallery Items
     */
    public function featured(): array
    {

        return $this
            ->where(
                'featured',
                1
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Media Type Wise Items
     */
    public function byType(
        string $type
    ): array
    {

        return $this
            ->where(
                'type',
                $type
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Album Wise Items
     */
    public function byAlbum(
        int $albumId
    ): array
    {

        return $this
            ->where(
                'album_id',
                $albumId
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

    }





    /**
     * Search Gallery
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'title',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }


}
