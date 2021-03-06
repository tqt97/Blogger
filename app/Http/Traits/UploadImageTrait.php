<?php

namespace App\Http;

use Illuminate\Http\Request;

class UploadImageTrait
{
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'file' => 'required|mimes:jpeg,png,jpg,bmp,gif',
        // ]);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }
    public function deleteFileFromServer($fileName)
    {
        $filePath = public_path() . '/uploads/' . $fileName;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }
    // public function delete(Request $request)
    // {
    //     $fileName = $request->imageName;
    //     $this->deleteFileFromServer($fileName);
    //     return 'DELETE';
    // }
}
