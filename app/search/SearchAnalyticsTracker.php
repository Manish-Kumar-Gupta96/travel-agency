<?php

declare(strict_types=1);

namespace App\Search;

class SearchAnalyticsTracker
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $logs = [];

    public function track(
        string $query,
        int $results,
        ?string $user = null
    ): void {

        $this->logs[] = [
            'query' => $query,
            'results' => $results,
            'user' => $user,
            'time' => date('c'),
        ];
    }

    public function popular(
        int $limit = 10
    ): array {

        $queries = [];

        foreach ($this->logs as $log) {

            $queries[$log['query']] =
                ($queries[$log['query']] ?? 0) + 1;
        }

        arsort($queries);

        return array_slice(
            $queries,
            0,
            $limit,
            true
        );
    }

    public function all(): array
    {
        return $this->logs;
    }
}
