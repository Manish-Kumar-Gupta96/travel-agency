<?php

namespace App\Core\Upload;

class Validator
{
    protected array $errors = [];

    /**
     * Validate Uploaded File
     */
    public function validate(
        array $file,
        array $rules = []
    ): bool {

        $this->errors = [];

        if (!isset($file['error'])) {
            $this->errors[] = 'Invalid upload data.';
            return false;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = $this->uploadError($file['error']);
            return false;
        }

        if (
            isset($rules['required']) &&
            $rules['required'] === true &&
            empty($file['name'])
        ) {
            $this->errors[] = 'File is required.';
        }

        if (
            isset($rules['max'])
            &&
            $file['size'] > $rules['max']
        ) {
            $this->errors[] = 'File size exceeded.';
        }

        if (
            isset($rules['min'])
            &&
            $file['size'] < $rules['min']
        ) {
            $this->errors[] = 'File size is too small.';
        }

        if (isset($rules['extensions'])) {

            $extension = strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );

            if (
                !in_array(
                    $extension,
                    $rules['extensions'],
                    true
                )
            ) {
                $this->errors[] =
                    'Invalid file extension.';
            }
        }

        if (isset($rules['mime'])) {

            $mime = mime_content_type(
                $file['tmp_name']
            );

            if (
                !in_array(
                    $mime,
                    $rules['mime'],
                    true
                )
            ) {
                $this->errors[] =
                    'Invalid file type.';
            }
        }

        if (
            !empty($rules['image'])
            &&
            @getimagesize($file['tmp_name']) === false
        ) {
            $this->errors[] =
                'Invalid image.';
        }

        return empty($this->errors);
    }

    /**
     * Upload Error Message
     */
    protected function uploadError(
        int $code
    ): string {

        return match ($code) {

            UPLOAD_ERR_INI_SIZE =>
                'File exceeds php.ini limit.',

            UPLOAD_ERR_FORM_SIZE =>
                'File exceeds form limit.',

            UPLOAD_ERR_PARTIAL =>
                'File uploaded partially.',

            UPLOAD_ERR_NO_FILE =>
                'No file uploaded.',

            UPLOAD_ERR_NO_TMP_DIR =>
                'Temporary directory missing.',

            UPLOAD_ERR_CANT_WRITE =>
                'Unable to write file.',

            UPLOAD_ERR_EXTENSION =>
                'Upload blocked by extension.',

            default =>
                'Unknown upload error.'

        };
    }

    /**
     * Validation Errors
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * First Error
     */
    public function firstError(): ?string
    {
        return $this->errors[0] ?? null;
    }

    /**
     * Validation Passed
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Validation Failed
     */
    public function fails(): bool
    {
        return !$this->passes();
    }

    /**
     * Reset Errors
     */
    public function reset(): static
    {
        $this->errors = [];

        return $this;
    }
}
