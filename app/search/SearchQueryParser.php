<?php

declare(strict_types=1);

namespace App\Search;

class SearchQueryParser
{
    public function parse(
        string $query
    ): array {

        $query = trim(
            strtolower($query)
        );

        if ($query === '') {
            return [];
        }

        return array_values(
            array_filter(
                explode(' ', $query)
            )
        );
    }

    public function hasOperator(
        string $query,
        string $operator
    ): bool {

        return str_contains(
            strtoupper($query),
            strtoupper($operator)
        );
    }
}
