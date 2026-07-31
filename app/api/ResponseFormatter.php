<?php

declare(strict_types=1);

namespace App\Api;

class ResponseFormatter
{
    public function success(
        mixed $data = null,
        string $message = 'Success'
    ): array {

        return [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];
    }

    public function error(
        string $message,
        int $code = 400,
        mixed $errors = null
    ): array {

        return [
            'status' => false,
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ];
    }

    public function paginate(
        array $items,
        int $page,
        int $limit,
        int $total
    ): array {

        return [
            'items' => $items,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'pages' => ceil(
                    $total / max($limit, 1)
                ),
            ],
        ];
    }
}
