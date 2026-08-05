<?php

namespace App\Models;

use App\Core\Database\Model;


class Hotel extends Model
{

    protected static string $table = 'hotels';


    protected array $fillable = [

        'destination_id',

        'name',

        'slug',

        'category',

        'rating',

        'address',

        'city',

        'country',

        'phone',

        'email',

        'description',

        'facilities',

        'rooms',

        'image',

        'price_per_night',

        'featured',

        'status',

    ];





    /**
     * Find Hotel By Slug
     */
    public function findBySlug(
        string $slug
    ): ?array
    {

        return $this
            ->where(
                'slug',
                $slug
            )
            ->first();

    }





    /**
     * Active Hotels
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
     * Featured Hotels
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
     * Destination Wise Hotels
     */
    public function byDestination(
        int $destinationId
    ): array
    {

        return $this
            ->where(
                'destination_id',
                $destinationId
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * City Wise Hotels
     */
    public function byCity(
        string $city
    ): array
    {

        return $this
            ->where(
                'city',
                $city
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Category Wise Hotels
     */
    public function byCategory(
        string $category
    ): array
    {

        return $this
            ->where(
                'category',
                $category
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Search Hotels
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
                    'city',
                    $keyword
                )

                ->orLike(
                    'country',
                    $keyword
                )

                ->orLike(
                    'category',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }





    /**
     * Price Range Hotels
     */
    public function priceRange(
        float $min,
        float $max
    ): array
    {

        return $this
            ->whereBetween(
                'price_per_night',
                $min,
                $max
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Rating Wise Hotels
     */
    public function ratingAbove(
        float $rating
    ): array
    {

        return $this
            ->where(
                'rating >=',
                $rating
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Enable Hotel
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
     * Disable Hotel
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
     * Hotel Statistics
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


            'average_rating' =>
                $this
                ->avg(
                    'rating'
                ),

        ];

    }





    /**
     * Hotel With Destination
     */
    public function withDestination(
        int $id
    ): array
    {

        return $this
            ->join(
                'destinations',
                'destinations.id = hotels.destination_id'
            )
            ->where(
                'hotels.id',
                $id
            )
            ->first();

    }


}
