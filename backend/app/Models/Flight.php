<?php

namespace App\Models;

use App\Core\Database\Model;


class Flight extends Model
{

    protected static string $table = 'flights';


    protected array $fillable = [

        'airline',

        'flight_number',

        'departure_city',

        'arrival_city',

        'departure_time',

        'arrival_time',

        'duration',

        'class',

        'seat_capacity',

        'price',

        'baggage',

        'status',

    ];





    /**
     * Find Flight Number
     */
    public function findByFlightNumber(
        string $flightNumber
    ): ?array
    {

        return $this
            ->where(
                'flight_number',
                $flightNumber
            )
            ->first();

    }





    /**
     * Active Flights
     */
    public function active(): array
    {

        return $this
            ->where(
                'status',
                'active'
            )
            ->orderBy(
                'departure_time',
                'ASC'
            )
            ->get();

    }





    /**
     * Airline Wise Flights
     */
    public function byAirline(
        string $airline
    ): array
    {

        return $this
            ->where(
                'airline',
                $airline
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Route Wise Flights
     */
    public function byRoute(
        string $departure,
        string $arrival
    ): array
    {

        return $this
            ->where(
                'departure_city',
                $departure
            )
            ->where(
                'arrival_city',
                $arrival
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Class Wise Flights
     */
    public function byClass(
        string $class
    ): array
    {

        return $this
            ->where(
                'class',
                $class
            )
            ->where(
                'status',
                'active'
            )
            ->get();

    }





    /**
     * Search Flights
     */
    public function search(
        string $keyword
    ): array
    {

        return $this
            ->groupStart()

                ->like(
                    'airline',
                    $keyword
                )

                ->orLike(
                    'flight_number',
                    $keyword
                )

                ->orLike(
                    'departure_city',
                    $keyword
                )

                ->orLike(
                    'arrival_city',
                    $keyword
                )

            ->groupEnd()
            ->get();

    }





    /**
     * Price Range Flights
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
     * Enable Flight
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
     * Disable Flight
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
     * Flight Statistics
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


            'airlines' =>
                $this
                ->distinct(
                    'airline'
                )
                ->count(),


            'routes' =>
                $this
                ->distinct(
                    'departure_city'
                )
                ->count(),

        ];

    }


}
