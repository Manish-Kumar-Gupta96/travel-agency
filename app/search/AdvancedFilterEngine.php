<?php

declare(strict_types=1);

namespace App\Search;

class AdvancedFilterEngine
{
    public function apply(
        array $items,
        array $filters
    ): array {

        return array_values(
            array_filter(
                $items,
                function ($item) use ($filters) {

                    foreach ($filters as $key => $value) {

                        if (
                            !isset($item[$key])
                            ||
                            $item[$key] !== $value
                        ) {
                            return false;
                        }
                    }

                    return true;
                }
            )
        );
    }

    public function contains(
        array $items,
        string $field,
        mixed $value
    ): array {

        return array_values(
            array_filter(
                $items,
                fn ($item) =>
                    isset($item[$field])
                    &&
                    str_contains(
                        (string) $item[$field],
                        (string) $value
                    )
            )
        );
    }
}
