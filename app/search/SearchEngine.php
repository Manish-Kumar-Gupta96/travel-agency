<?php

declare(strict_types=1);

namespace App\Search;

class SearchEngine
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $documents = [];

    public function index(
        string $id,
        array $document
    ): void {

        $this->documents[$id] = $document;
    }

    public function remove(
        string $id
    ): void {

        unset(
            $this->documents[$id]
        );
    }

    public function search(
        string $query
    ): array {

        $results = [];

        foreach ($this->documents as $id => $document) {

            $content = strtolower(
                json_encode($document)
            );

            if (
                str_contains(
                    $content,
                    strtolower($query)
                )
            ) {
                $results[$id] = $document;
            }
        }

        return $results;
    }

    public function count(): int
    {
        return count(
            $this->documents
        );
    }
}
