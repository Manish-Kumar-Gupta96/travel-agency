<?php

declare(strict_types=1);

namespace App\Search;

class SearchCacheManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $cache = [];

    public function store(
        string $query,
        array $results,
        int $ttl = 300
    ): void {

        $this->cache[$query] = [
            'results' => $results,
            'expires' => time() + $ttl,
        ];
    }

    public function get(
        string $query
    ): ?array {

        if (!isset($this->cache[$query])) {
            return null;
        }

        if (
            $this->cache[$query]['expires']
            < time()
        ) {
            unset(
                $this->cache[$query]
            );

            return null;
        }

        return $this->cache[$query]['results'];
    }

    public function clear(): void
    {
        $this->cache = [];
    }
}
