<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Services\File\FileManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller{
    public function store(Request $request,FileManager $fm): JsonResponse
    {
        $request->validate([
            'file' => 'required|max:2048',
            'directory' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $file_uploaded = $fm->upload([$file],$request->input('directory'));

        return new JsonResponse(['message'=>'با موفقیت بارگذاری شد','file'=>$file_uploaded]);
    }
}
