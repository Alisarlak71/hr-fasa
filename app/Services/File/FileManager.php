<?php

namespace App\Services\File;

use App\Models\File;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public function index(Request $request, $perPage, int $currentPage, ?string $searchTerm): array
    {
        $files = [];
        if (empty($request->directory) || !array_key_exists($request->directory, File::$folders)) {
            foreach (File::$folders as $key => $val) {
                $files[] = [
                    'path' => '',
                    'name' => $key,
                    'isFolder' => true,
                    'downloadLink' => ''
                ];
            }
            return $files;
        }
        $mediable_type = File::$folders[$request->directory];
        $query = File::whereFormType($mediable_type);

        if (!empty($searchTerm)) {
            $query->where('path', 'LIKE', '%' . $searchTerm . '%');
        }

        $getFiles = ($perPage == 'all' ? $query->get() : $query->paginate($perPage, ['*'], 'page', $currentPage));
        foreach ($getFiles as $file) {
            $files[] = [
                'id' => $file->id,
                'path' => $file->path,
                'name' => basename($file->path),
                'isFolder' => false,
                'downloadLink' => asset('storage/' . $file->path)
            ];
        }

        return [
            'files' => $files,
            'pagination' => [
                'current_page' => ($perPage == 'all' ? 0 : $getFiles->currentPage()),
                'per_page' => ($perPage == 'all' ? 0 : $getFiles->perPage()),
                'total' => ($perPage == 'all' ? 0 : $getFiles->total())
            ]
        ];
    }


    public function getContents(string $path): array
    {
        $files = Storage::disk('public')->files($path);
        $directories = Storage::disk('public')->directories($path);

        return [
            'files' => $files,
            'directories' => $directories
        ];
    }

    public function upload(array $uploadedFiles, ?string $directory, ?array $alt = null): array
    {
        $uploadedFilePaths = [];

        foreach ($uploadedFiles as $uploadedFile) {
            $uploadedFilePaths[] = $this->storeUploadedFile($uploadedFile, $directory);
        }

        // Store uploaded file paths in the database
        $uploadedFileInfos = $this->storeUploadedFilePathsInDatabase($uploadedFilePaths, $alt);
        return $uploadedFileInfos;
    }

    private function storeUploadedFile($file, $directory): array
    {
        $originalFileName = $file->getClientOriginalName();
        $newFileName = uniqid() . '_' . $originalFileName;

        $file->storeAs('public/' . $directory, $newFileName);

        return [
            'form_type' => (array_key_exists($directory, File::$folders) ? File::$folders[$directory] : null),
            'path' => $directory . '/' . $newFileName,
        ];
    }

    private function storeUploadedFilePathsInDatabase($filePaths, ?array $alt): array
    {
        $uploadedFileInfos = [];

        foreach ($filePaths as $key => $filePathInfo) {
            $file = new File([
                'form_type' => $filePathInfo['form_type'],
                'path' => $filePathInfo['path'],
            ]);
            $file->save();

            // Add the file info to the result array
            $uploadedFileInfos[] = $file->toArray();
        }

        return $uploadedFileInfos;
    }


    public function delete(array $fileIds): JsonResponse
    {
        try {
            foreach ($fileIds as $fileId) {
                $file = File::query()->find($fileId);

                if (!$file) {
                    continue;
                }

                Storage::delete(storage_path($file->path));
                $file->delete();
            }

            return response()->json(['message' => trans('messages.public.deleted')]);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function attachFile(string $directory, int $mediableId, ?array $files, ?string $type = 'image'): void
    {
        $mediableType = File::$folders[$directory];
        $fileIds = [];

        if (!$files) {
            $this->resetUnattachedFiles($mediableType, $mediableId, $fileIds, $type);
            return;
        }

        foreach ($files as $fileData) {
            if (is_object($fileData))
                $fileData = get_object_vars($fileData);
            $fileIds[] = $fileData['id'];
            $file = File::query()->find($fileData['id']);
            $old_type = $file->type;
            if (!is_null($type)) {
                $file->type = File::$fileType[$type];
            }
            if ((!is_null($file->form_id) && $file->form_id != $mediableId) || $file->type != $old_type) {
                $getFile = File::whereFormId($mediableId)
                    ->whereFormType($mediableType)
                    ->wherePath($file->path);

                if (!is_null($type)) {
                    $getFile = $getFile->where('type', File::$fileType[$type]);
                }

                $getFile = $getFile->first();

                if ($getFile) {
                    // Update the attributes of the existing file with optional data
                    $this->updateFileAttributesWithOptionalData($getFile->id, $fileData);
                    $fileIds[] = $getFile->id;
                    continue;
                }

                $newFileId = $this->createNewFile($file, $mediableId, $mediableType, File::$fileType[$type] ?? null);
                $fileIds[] = $newFileId;
                $this->updateFileAttributesWithOptionalData($newFileId, $fileData);
            } else {
                $this->updateFileAttributes($file, $mediableId, $mediableType);
                $this->updateFileAttributesWithOptionalData($file->id, $fileData);
            }
        }

        $this->resetUnattachedFiles($mediableType, $mediableId, $fileIds, $type);
    }

    private function updateFileAttributes(File $file, int $mediableId, string $mediableType): void
    {
        $file->form_id = $mediableId;
        $file->form_type = $mediableType;
        $file->save();
    }

    private function createNewFile(File $file, int $mediableId, string $mediableType, ?int $type = null): int
    {
        $newFile = new File();
        $newFile->form_id = $mediableId;
        $newFile->form_type = $mediableType;
        $newFile->path = $file->path;
        $newFile->type = $type ?? 0;
        $newFile->save();
        return $newFile->id;
    }

    private function resetUnattachedFiles(string $mediableType, int $mediableId, array $fileIds, ?string $type): void
    {

        if (!is_null($type)) {
            $type = File::$fileType[$type];
        } else {
            $type = 0;
        }

        File::whereFormId($mediableId)->whereFormType($mediableType)->whereNotIn('id', $fileIds)->where('type', $type)->update(['form_id' => null]);
    }

    private function updateFileAttributesWithOptionalData(int $fileId, array $fileData): void
    {
        $file = File::query()->find($fileId);

        if (isset($fileData['alt'])) {
            $file->alt = $fileData['alt'];
        }

        if (isset($fileData['is_default'])) {
            if ($fileData['is_default'] == 1) {
                File::whereFormType($file->form_type)->whereFormId($file->form_id)->update(['is_default' => 0]);
            }

            $file->is_default = $fileData['is_default'];
        }

        $file->save();
    }
}
