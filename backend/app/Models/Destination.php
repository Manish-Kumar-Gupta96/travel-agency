<?php

namespace App\Models;

use App\Core\Database\Model;


class Destination extends Model
{

    protected static string $table = 'destinations';


    protected array $fillable = [

        'name',

        'country',

        'state',

        'city',

        'description',

        'short_description',

        'featured_image',

        'banner_image',

        'best_time',

        'currency',

        'language',

        'timezone',

        'featured',

        'status',

    ];





    /**
     * Find Destination By Name
     */
    public function findByName(
        string $name
    ): ?array
    {

        return $this
            ->where(
                'name',
                $name
            )
            ->first();

    }





    /**
     * Active Destinations
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                'active'
            )
            ->orderBy(
                'name',
                'ASC'
            )
            ->get();

    }





    /**
     * Featured Destinations
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
     * Country Wise Destinations
     */
    public function byCountry(
        string $country
    ): array
    {

        return $this
            ->where(
                'country',
                $country
            )
            ->get();

    }





    /**
     * Search Destination
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'name',
                    $keyword
                )

                ->orLike(
                    'country',
                    $keyword
                )

                ->orLike(
                    'state',
                    $keyword
                )

                ->orLike(
                    'city',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }





    /**
     * Get Countries List
     */
    public function countries(): array
    {

        return $this
            ->distinct('country')
            ->get();

    }





    /**
     * Enable Destination
     */
    public function enable(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'status' => 'active'

            ]
        );

    }





    /**
     * Disable Destination
     */
    public function disable(
        int $id
    ): bool
    {

        return $this->update(
            $id,
            [

                'status' => 'inactive'

            ]
        );

    }





    /**
     * Destination Statistics
     */
    public function statistics(): array
    {

        return [

            'total' =>
                $this->count(),


            'active' =>
                $this
                ->where(
                    'status',
                    'active'
                )
                ->count(),


            'inactive' =>
                $this
                ->where(
                    'status',
                    'inactive'
                )
                ->count(),


            'featured' =>
                $this
                ->where(
                    'featured',
                    1
                )
                ->count(),


            'countries' =>
                $this
                ->distinct('country')
                ->count(),

        ];

    }


}
