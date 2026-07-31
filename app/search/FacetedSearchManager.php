<?php

declare(strict_types=1);

namespace App\Search;

class FacetedSearchManager
{
    /**
     * @var array<string,array<string,int>>
     */
    private array $facets = [];

    public function add(
        string $facet,
        string $value
    ): void {

        $this->facets[$facet][$value] =
            ($this->facets[$facet][$value] ?? 0) + 1;
    }

    public function values(
        string $facet
    ): array {

        return $this->facets[$facet] ?? [];
    }

    public function all(): array
    {
        return $this->facets;
    }

    public function clear(): void
    {
        $this->facets = [];
    }
}
