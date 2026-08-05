<?php

namespace App\Models;

use App\Core\Database\Model;


class Visa extends Model
{

    protected static string $table = 'visas';


    protected array $fillable = [

        'country',

        'visa_type',

        'processing_time',

        'validity',

        'entry_type',

        'price',

        'documents_required',

        'description',

        'image',

        'status',

    ];





    /**
     * Find Visa By Country
     */
    public function findByCountry(
        string $country
    ): ?array
    {

        return $this
            ->where(
                'country',
                $country
            )
            ->first();

    }





    /**
     * Active Visas
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                'active'
            )
            ->orderBy(
                'country',
                'ASC'
            )
            ->get();

    }





    /**
     * Country Wise Visa
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
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Visa Type Wise
     */
    public function byType(
        string $type
    ): array
    {

        return $this
            ->where(
                'visa_type',
                $type
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Search Visa
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'country',
                    $keyword
                )

                ->orLike(
                    'visa_type',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }





    /**
     * Enable Visa
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
     * Disable Visa
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
     * Visa Statistics
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


            'countries' =>
                $this
                ->distinct(
                    'country'
                )
                ->count(),

        ];

    }


}
