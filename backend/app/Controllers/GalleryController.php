<?php

namespace App\Controllers;

use App\Services\GalleryService;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Exception;

class GalleryController
{
    protected GalleryService $galleryService;

    public function __construct(
        GalleryService $galleryService
    ) {
        $this->galleryService = $galleryService;
    }

    /**
     * Get All Gallery Items
     */
    public function index(
        Request $request,
        Response $response
    ) {
        try {
            $items = $this->galleryService->all();

            return $response->json([
                'success' => true,
                'data' => $items,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Gallery Item Details
     */
    public function show(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $item = $this->galleryService->find($id);

            return $response->json([
                'success' => true,
                'data' => $item,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Create Gallery Item
     */
    public function store(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $item = $this->galleryService->create($data);

            return $response->json([
                'success' => true,
                'message' => 'Gallery item created successfully.',
                'data' => $item,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Gallery Item
     */
    public function update(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $data = $request->all();
            $item = $this->galleryService->update($id, $data);

            return $response->json([
                'success' => true,
                'message' => 'Gallery item updated successfully.',
                'data' => $item,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Delete Gallery Item
     */
    public function destroy(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $result = $this->galleryService->delete($id);

            return $response->json([
                'success' => true,
                'message' => 'Gallery item deleted successfully.',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Search Gallery Items
     */
    public function search(
        Request $request,
        Response $response
    ) {
        try {
            $keyword = $request->input('keyword') ?? '';
            $items = $this->galleryService->search($keyword);

            return $response->json([
                'success' => true,
                'data' => $items,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Create Album
     */
    public function storeAlbum(
        Request $request,
        Response $response
    ) {
        try {
            $data = $request->all();
            $album = $this->galleryService->createAlbum($data);

            return $response->json([
                'success' => true,
                'message' => 'Album created successfully.',
                'data' => $album,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get All Albums
     */
    public function albums(
        Request $request,
        Response $response
    ) {
        try {
            $albums = $this->galleryService->albums();

            return $response->json([
                'success' => true,
                'data' => $albums,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get Album Items
     */
    public function albumItems(
        Request $request,
        Response $response,
        int $albumId
    ) {
        try {
            $items = $this->galleryService->albumItems($albumId);

            return $response->json([
                'success' => true,
                'data' => $items,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Upload Media
     */
    public function upload(
        Request $request,
        Response $response
    ) {
        try {
            $file = $request->file('file');
            if (!$file && isset($_FILES['file'])) {
                $file = $_FILES['file'];
            }

            if (!$file) {
                throw new Exception('No media file uploaded.');
            }

            $filename = time() . '_' . basename($file['name']);
            $targetDir = dirname(__DIR__, 2) . '/public/storage/uploads';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $targetFile = $targetDir . '/' . $filename;

            if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
                throw new Exception('Failed to upload file.');
            }

            $meta = $request->all();
            $fileData = [
                'file' => $filename,
            ];

            $item = $this->galleryService->upload($fileData, $meta);

            return $response->json([
                'success' => true,
                'message' => 'Media uploaded successfully.',
                'data' => $item,
            ], 201);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Featured Gallery Items
     */
    public function featured(
        Request $request,
        Response $response
    ) {
        try {
            $items = $this->galleryService->featured();

            return $response->json([
                'success' => true,
                'data' => $items,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get Gallery Items By Type
     */
    public function type(
        Request $request,
        Response $response
    ) {
        try {
            $type = $request->input('type') ?? 'image';
            $items = $this->galleryService->byType($type);

            return $response->json([
                'success' => true,
                'data' => $items,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update Gallery Item Status
     */
    public function status(
        Request $request,
        Response $response,
        int $id
    ) {
        try {
            $status = $request->input('status') ?? 'active';
            $result = $this->galleryService->updateStatus($id, $status);

            return $response->json([
                'success' => true,
                'message' => 'Gallery item status updated successfully.',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Gallery Reports
     */
    public function reports(
        Request $request,
        Response $response
    ) {
        try {
            $reports = $this->galleryService->reports();

            return $response->json([
                'success' => true,
                'data' => $reports,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Gallery Statistics
     */
    public function statistics(
        Request $request,
        Response $response
    ) {
        try {
            $stats = $this->galleryService->statistics();

            return $response->json([
                'success' => true,
                'data' => $stats,
            ]);
        } catch (Exception $e) {
            return $response->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
