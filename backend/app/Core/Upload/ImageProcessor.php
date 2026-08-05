<?php

namespace App\Core\Upload;

use RuntimeException;

class ImageProcessor
{
    /**
     * Resize Image
     */
    public function resize(
        string $source,
        string $destination,
        int $width,
        int $height,
        int $quality = 90
    ): bool {

        $image = $this->createImage($source);

        if (!$image) {
            throw new RuntimeException('Unsupported image.');
        }

        $originalWidth  = imagesx($image);
        $originalHeight = imagesy($image);

        $canvas = imagecreatetruecolor(
            $width,
            $height
        );

        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);

        imagecopyresampled(
            $canvas,
            $image,
            0,
            0,
            0,
            0,
            $width,
            $height,
            $originalWidth,
            $originalHeight
        );

        $result = $this->saveImage(
            $canvas,
            $destination,
            $quality
        );

        imagedestroy($image);
        imagedestroy($canvas);

        return $result;
    }

    /**
     * Create Thumbnail
     */
    public function thumbnail(
        string $source,
        string $destination,
        int $size = 300
    ): bool {

        return $this->resize(
            $source,
            $destination,
            $size,
            $size
        );
    }

    /**
     * Compress Image
     */
    public function compress(
        string $source,
        string $destination,
        int $quality = 75
    ): bool {

        $image = $this->createImage($source);

        if (!$image) {
            throw new RuntimeException('Unsupported image.');
        }

        $result = $this->saveImage(
            $image,
            $destination,
            $quality
        );

        imagedestroy($image);

        return $result;
    }

    /**
     * Image Information
     */
    public function info(
        string $file
    ): array {

        if (!file_exists($file)) {
            throw new RuntimeException('Image not found.');
        }

        $info = getimagesize($file);

        return [

            'width'  => $info[0],
            'height' => $info[1],
            'mime'   => $info['mime'],
            'size'   => filesize($file)

        ];
    }

    /**
     * Validate Image
     */
    public function validate(
        string $file
    ): bool {

        if (!file_exists($file)) {
            return false;
        }

        return @getimagesize($file) !== false;
    }

    /**
     * Create GD Image
     */
    protected function createImage(
        string $file
    ) {

        $type = exif_imagetype($file);

        return match ($type) {

            IMAGETYPE_JPEG => imagecreatefromjpeg($file),

            IMAGETYPE_PNG  => imagecreatefrompng($file),

            IMAGETYPE_GIF  => imagecreatefromgif($file),

            default => null

        };
    }

    /**
     * Save Image
     */
    protected function saveImage(
        $image,
        string $file,
        int $quality = 90
    ): bool {

        $extension = strtolower(
            pathinfo(
                $file,
                PATHINFO_EXTENSION
            )
        );

        return match ($extension) {

            'jpg',
            'jpeg' => imagejpeg(
                $image,
                $file,
                $quality
            ),

            'png' => imagepng(
                $image,
                $file,
                (int) round((100 - $quality) / 10)
            ),

            'gif' => imagegif(
                $image,
                $file
            ),

            default => false

        };
    }

    /**
     * Delete Image
     */
    public function delete(
        string $file
    ): bool {

        if (!file_exists($file)) {
            return false;
        }

        return unlink($file);
    }
}
