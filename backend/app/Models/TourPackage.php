<?php

namespace App\Models;

use App\Core\Database\Model;


class TourPackage extends Model
{

    protected static string $table = 'tour_packages';


    protected array $fillable = [

        'title',

        'slug',

        'destination_id',

        'category',

        'duration',

        'price',

        'discount_price',

        'max_people',

        'description',

        'highlights',

        'itinerary',

        'included',

        'excluded',

        'featured_image',

        'gallery',

        'featured',

        'status',

    ];





    /**
     * Find Package By Slug
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
     * Active Packages
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                'active'
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get();

    }





    /**
     * Featured Packages
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
     * Destination Wise Packages
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
     * Category Wise Packages
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
     * Search Packages
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

                ->orLike(
                    'category',
                    $keyword
                )

                ->orLike(
                    'description',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }





    /**
     * Price Range Filter
     */
    public function priceRange(
        float $min,
        float $max
    ): array
    {

        return $this
            ->whereBetween(
                'price',
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
     * Discount Packages
     */
    public function discounted(): array
    {

        return $this
            ->where(
                'discount_price >',
                0
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Enable Package
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
     * Disable Package
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
     * Package Statistics
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


            'categories' =>
                $this
                ->distinct('category')
                ->count(),

        ];

    }





    /**
     * Get Package With Destination
     */
    public function withDestination(
        int $id
    ): array
    {

        return $this
            ->join(
                'destinations',
                'destinations.id = tour_packages.destination_id'
            )
            ->where(
                'tour_packages.id',
                $id
            )
            ->first();

    }


}
