<?php

namespace App\Services\Uploader;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Uploader
{
    public string $path = '';


    public function storeFile(UploadedFile $file): void
    {
        $originalFileName = $file->getClientOriginalName();
        $newFileName = uniqid() . '_' . $originalFileName;

        $filePath = $file->storeAs('reports', $newFileName, 'public');
        $this->path = $filePath;
    }

    /**
     * @throws HttpClientException
     */
    public function unzip(): string
    {
        $zipFilePath = Storage::disk('public')->path($this->path);

        if (!file_exists($zipFilePath)) {
            throw new HttpClientException('Extract failed : فایل یافت نشد', 500);
        }

        $zip = new ZipArchive();
        $zipFile = $zip->open($zipFilePath);
        if ($zipFile === true) {
            $extractPath = Storage::disk('public')->path('csv');
            $extractResult = $zip->extractTo($extractPath);
            $extractedFiles = 0;

            if ($extractResult === true) {

               if(  $zip->numFiles>0) {
                   $filename = $zip->getNameIndex(0);
                   $extractedFiles = $extractPath . '/' . $filename;
                   $zip->close();
                }
                return $extractedFiles;
            } else {
                $zip->close();
                throw new HttpClientException('Extract failed : استخراج فایل با خطا مواجه شد', 500);
            }
        } else {
            throw new HttpClientException('Extract failed : فایل بارگذاری شده قابل خواندن نیست', 500);
        }
    }
}



