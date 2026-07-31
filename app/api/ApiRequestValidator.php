<?php

declare(strict_types=1);

namespace App\Api;

class ApiRequestValidator
{
    public function validate(
        array $data,
        array $rules
    ): array {

        $errors = [];

        foreach ($rules as $field => $requirements) {

            foreach ($requirements as $rule) {

                if (
                    $rule === 'required'
                    &&
                    !isset($data[$field])
                ) {
                    $errors[$field][] =
                        'Field is required.';
                }

                if (
                    $rule === 'string'
                    &&
                    isset($data[$field])
                    &&
                    !is_string($data[$field])
                ) {
                    $errors[$field][] =
                        'Must be a string.';
                }

                if (
                    $rule === 'array'
                    &&
                    isset($data[$field])
                    &&
                    !is_array($data[$field])
                ) {
                    $errors[$field][] =
                        'Must be an array.';
                }
            }
        }

        return $errors;
    }

    public function passes(
        array $data,
        array $rules
    ): bool {

        return empty(
            $this->validate(
                $data,
                $rules
            )
        );
    }
}
