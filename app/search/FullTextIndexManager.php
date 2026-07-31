<?php

declare(strict_types=1);

namespace App\Search;

class FullTextIndexManager
{
    /**
     * @var array<string,array<int,string>>
     */
    private array $index = [];

    public function add(
        string $word,
        string $documentId
    ): void {

        $word = strtolower($word);

        $this->index[$word] ??= [];

        if (!in_array(
            $documentId,
            $this->index[$word],
            true
        )) {
            $this->index[$word][] = $documentId;
        }
    }

    public function find(
        string $word
    ): array {

        return $this->index[
            strtolower($word)
        ] ?? [];
    }

    public function remove(
        string $word,
        string $documentId
    ): void {

        if (!isset($this->index[$word])) {
            return;
        }

        $this->index[$word] = array_values(
            array_filter(
                $this->index[$word],
                fn ($id) => $id !== $documentId
            )
        );
    }

    public function all(): array
    {
        return $this->index;
    }
}
