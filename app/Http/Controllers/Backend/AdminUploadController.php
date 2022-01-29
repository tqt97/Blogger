<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUploadController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,jpg,bmp,gif',
        ]);
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
    public function delete(Request $request)
    {
        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName);
        return 'DELETE';
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,png,jpg,bmp,gif',
        ]);
        $picName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $picName);
        return response()->json([
            'success' => 1,
            'file' => [
                'url' =>    "http://127.0.0.1:8000/uploads/$picName"
            ]
        ]);
        return $picName;
    }
}
