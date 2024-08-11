<?php

namespace App\Services;

use App\Enums\FileStatuses;
use App\Enums\FileTypes;
use App\Models\ReportFileLog;
use App\Services\Uploader\Uploader;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\Integer;

class ReportManager
{
    public Uploader $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param UploadedFile $file
     * @param int $type
     * @return ReportFileLog|UploadedFile
     * @throws HttpClientException
     */
    public function uploadFile(UploadedFile $file, int $type): ReportFileLog|UploadedFile
    {
        $filename = $file->getClientOriginalName();
        $uniqueFilename = ReportFileLog::getUniqueFilename($filename);
        $file_log = new ReportFileLog();
        $file_log->size = $file->getSize();
        $file_log->type = $type;
        $file_log->format = $file->getMimeType();
        $file_log->name = $uniqueFilename;
        $file_log->user_id = \Auth::id();

        try {
            $this->uploader->storeFile($file);

//            $csv_path = $this->uploader->unzip();
            $file_log->path = $this->uploader->path;
            $file_log->status = FileStatuses::EXTRACTED;
        } catch (HttpClientException $exception) {
            $file_log->status = FileStatuses::EXTRACTED_ERROR;
            throw new HttpClientException($exception->getMessage(),500);
        }
        $file_log->save();

        return $file_log;
    }
}
