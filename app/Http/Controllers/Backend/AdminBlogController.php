<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminBlogController extends Controller
{
    public function index()
    {
        return Blog::with('tag', 'cat')->orderBy('id', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $categories = $request->category_id;
        $tags = $request->tag_id;

        $blogCategories = [];
        $blogTags = [];
        DB::beginTransaction();
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => $request->title,
                'post' => $request->post,
                'post_excerpt' => $request->post_excerpt,
                'user_id' => Auth::user()->id,
                'metaDescription' => $request->metaDescription,
                'jsonData' => $request->jsonData,
            ]);
            foreach ($categories as $category) {
                array_push($blogCategories, ['category_id' => $category, 'blog_id' => $blog->id]);
            }
            BlogCategory::insert($blogCategories);

            foreach ($tags as $tag) {
                array_push($blogTags, ['tag_id' => $tag, 'blog_id' => $blog->id]);
            }
            BlogTag::insert($blogTags);
            DB::commit();
            return 'success';
        } catch (\Throwable $th) {
            DB::rollback();
            return 'Oops, something went wrong 💥';
        }
    }
    public function edit(Request $request, $id)
    {
        return Blog::with(['tag', 'cat'])->where('id', $id)->first();
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'post' => 'required',
            'post_excerpt' => 'required',
            'metaDescription' => 'required',
            'jsonData' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);
        $categories = $request->category_id;
        $tags = $request->tag_id;
        $blogCategories = [];
        $blogTags = [];

        DB::beginTransaction();
        try {
            $blog = Blog::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->title,
                'post' => $request->post,
                'post_excerpt' => $request->post_excerpt,
                'user_id' => Auth::user()->id,
                'metaDescription' => $request->metaDescription,
                'jsonData' => $request->jsonData,
            ]);
            // insert blog categories
            foreach ($categories as $c) {
                array_push($blogCategories, ['category_id' => $c, 'blog_id' => $id]);
            }
            // delete all previous categories
            BlogCategory::where('blog_id', $id)->delete();
            BlogCategory::insert($blogCategories);
            // insert blog tags
            foreach ($tags as $t) {
                array_push($blogTags, ['tag_id' => $t, 'blog_id' => $id]);
            }
            BlogTag::where('blog_id', $id)->delete();
            BlogTag::insert($blogTags);
            DB::commit();
            return 'done';
        } catch (\Throwable $e) {
            DB::rollback();
            return 'not done';
        }
    }
    public function delete(Request $request)
    {
        return Blog::where('id', $request->id)->delete();
    }
}
