<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\Album;
use Exception;

class GalleryService
{
    protected Gallery $galleryModel;
    protected Album $albumModel;

    public function __construct(
        Gallery $galleryModel,
        Album $albumModel
    ) {
        $this->galleryModel = $galleryModel;
        $this->albumModel = $albumModel;
    }

    /**
     * Get All Gallery Items
     */
    public function all(): array
    {
        return $this->galleryModel
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * Find Gallery Item
     */
    public function find(
        int $id
    ): array {
        $item = $this->galleryModel->find($id);

        if (!$item) {
            throw new Exception('Gallery item not found.');
        }

        return $item;
    }

    /**
     * Create Gallery Item
     */
    public function create(
        array $data
    ): array {
        $this->validateGallery(
            $data
        );

        $id = $this->galleryModel->create([
            'title'    => $data['title'],
            'type'     => $data['type'] ?? 'image',
            'url'      => $data['url'] ?? '',
            'album_id' => $data['album_id'] ?? null,
            'status'   => $data['status'] ?? 'active',
            'featured' => $data['featured'] ?? 0
        ]);

        return $this->find($id);
    }

    /**
     * Update Gallery Item
     */
    public function update(
        int $id,
        array $data
    ): array {
        $item = $this->find($id);

        $this->validateGallery(
            $data,
            false
        );

        $payload = [
            'title'    => $data['title'] ?? $item['title'],
            'type'     => $data['type'] ?? $item['type'],
            'url'      => $data['url'] ?? $item['url'],
            'album_id' => $data['album_id'] ?? $item['album_id'],
            'status'   => $data['status'] ?? $item['status'],
            'featured' => $data['featured'] ?? $item['featured']
        ];

        $this->galleryModel->update(
            $id,
            $payload
        );

        return $this->find($id);
    }

    /**
     * Delete Gallery Item
     */
    public function delete(
        int $id
    ): bool {
        $this->find($id);

        return $this->galleryModel->delete($id);
    }

    /**
     * Search Gallery
     */
    public function search(
        string $keyword
    ): array {
        return $this->galleryModel
            ->groupStart()
                ->like('title', $keyword)
            ->groupEnd()
            ->get();
    }

    /**
     * Create Album
     */
    public function createAlbum(
        array $data
    ): array {
        if (
            empty($data['name'])
        ) {
            throw new Exception(
                "Album name required"
            );
        }

        $id = $this->albumModel->create([
            'name'        => $data['name'],
            'description' => $data['description'] ?? '',
            'status'      => $data['status'] ?? 'active'
        ]);

        $album = $this->albumModel->find($id);
        if (!$album) {
            throw new Exception('Album creation failed.');
        }

        return $album;
    }

    /**
     * Get Albums
     */
    public function albums(): array
    {
        return $this->albumModel
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * Album Gallery Items
     */
    public function albumItems(
        int $albumId
    ): array {
        return $this->galleryModel
            ->where('album_id', $albumId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * Upload Media
     */
    public function upload(
        array $fileData,
        array $meta = []
    ): array {
        if (
            empty($fileData['file'])
        ) {
            throw new Exception(
                "Media file required"
            );
        }

        $filename = time() . '_' . basename($fileData['file']);
        $destination = '/storage/uploads/' . $filename;

        $id = $this->galleryModel->create([
            'title'    => $meta['title'] ?? basename($fileData['file']),
            'type'     => $meta['type'] ?? 'image',
            'url'      => $destination,
            'album_id' => $meta['album_id'] ?? null,
            'status'   => 'active',
            'featured' => $meta['featured'] ?? 0
        ]);

        return $this->find($id);
    }

    /**
     * Featured Gallery
     */
    public function featured(): array
    {
        return $this->galleryModel
            ->where('featured', 1)
            ->where('status', 'active')
            ->get();
    }

    /**
     * Gallery By Type
     */
    public function byType(
        string $type
    ): array {
        $allowedTypes = [
            'image',
            'video'
        ];

        if (
            !in_array(
                $type,
                $allowedTypes,
                true
            )
        ) {
            throw new Exception(
                "Invalid media type"
            );
        }

        return $this->galleryModel
            ->where('type', $type)
            ->where('status', 'active')
            ->get();
    }

    /**
     * Update Gallery Status
     */
    public function updateStatus(
        int $id,
        string $status
    ): bool {
        $allowedStatus = [
            'active',
            'inactive',
            'draft'
        ];

        if (
            !in_array(
                $status,
                $allowedStatus,
                true
            )
        ) {
            throw new Exception(
                "Invalid gallery status"
            );
        }

        $this->find($id);

        return $this->galleryModel->update(
            $id,
            [
                'status' => $status
            ]
        );
    }

    /**
     * Gallery Reports
     */
    public function reports(): array
    {
        return [
            'total_images' => $this->galleryModel->where('type', 'image')->count(),
            'total_videos' => $this->galleryModel->where('type', 'video')->count(),
            'albums_count' => $this->albumModel->count(),
        ];
    }

    /**
     * Statistics
     */
    public function statistics(): array
    {
        return [
            'total'    => $this->galleryModel->count(),
            'active'   => $this->galleryModel->where('status', 'active')->count(),
            'inactive' => $this->galleryModel->where('status', 'inactive')->count(),
            'featured' => $this->galleryModel->where('featured', 1)->count()
        ];
    }

    /**
     * Validate Gallery Data
     */
    protected function validateGallery(
        array $data,
        bool $required = true
    ): void {
        if (
            $required
            &&
            empty($data['title'])
        ) {
            throw new Exception(
                "Gallery title required"
            );
        }

        if (
            isset($data['type'])
            &&
            !in_array(
                $data['type'],
                [
                    'image',
                    'video'
                ],
                true
            )
        ) {
            throw new Exception(
                "Invalid gallery type"
            );
        }
    }
}
