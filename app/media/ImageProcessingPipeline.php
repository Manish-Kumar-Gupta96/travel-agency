<?php

declare(strict_types=1);

namespace App\Media;

class ImageProcessingPipeline
{
    /**
     * @var array<int,callable>
     */
    private array $processors = [];

    public function add(
        callable $processor
    ): void {

        $this->processors[] = $processor;
    }

    public function process(
        mixed $image
    ): mixed {

        foreach ($this->processors as $processor) {

            $image = call_user_func(
                $processor,
                $image
            );
        }

        return $image;
    }

    public function count(): int
    {
        return count(
            $this->processors
        );
    }
}
