<?php

declare(strict_types=1);

namespace App\Search;

class SearchRankingEngine
{
    public function rank(
        array $results,
        string $keyword
    ): array {

        $scores = [];

        foreach ($results as $id => $content) {

            $text = strtolower(
                json_encode($content)
            );

            $scores[$id] = substr_count(
                $text,
                strtolower($keyword)
            );
        }

        arsort($scores);

        return $scores;
    }

    public function sort(
        array $results,
        array $scores
    ): array {

        uksort(
            $results,
            fn ($a, $b) =>
                ($scores[$b] ?? 0)
                <=>
                ($scores[$a] ?? 0)
        );

        return $results;
    }
}
