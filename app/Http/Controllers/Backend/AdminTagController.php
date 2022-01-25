<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    public function index()
    {
        return Tag::orderBy('id', 'desc')->get();
    }
    public function store(StoreTagRequest $request)
    {
        return  Tag::create([
            'tagName' => $request->tagName
        ]);
    }
    public function update(UpdateTagRequest $request)
    {
        Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);
        return  response()->json([
            'tagName' => $request->tagName
        ]);
    }
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        return  Tag::where('id', $request->id)->delete();
    }
}
