<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data' => $post]);
        return PostDetailResource::collection($posts->loadMissing(['writer:id,username', 'comments:id,post_id,user_id,comment_content']));
    }

    public function show($id)
    {
        $post = Post::with(['writer:id,username'])->findOrFail($id);
        return new PostDetailResource($post->loadMissing(['writer:id,username', 'comments:id,post_id,user_id,comment_content']));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:225',
            'news_content' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|nullable'
        ]);

        $image = $request->file('file')->store('image', 'public');
        $validate['image'] = $image;
        $validate['author'] = Auth::id();
        $post = Post::create($validate);
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png'
        ]);

        $post = Post::findOrFail($id);
        if ($request->hasFile('file')) {
            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }
            $validate['image'] = $request->file('file')->store('image', 'public');
        }
        $post->update($validate);
        return response()->json(['message' => 'berhasil mengupdate']);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(['message' => 'data post deleted']);
    }
}
