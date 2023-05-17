<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment_content' => 'required'
        ]);
        $validate['user_id'] = Auth::id();
        $comment = Comment::create($validate);
        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'comment_content' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validate);
        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return response()->json(['message' => 'commentar deleted successed']);
    }
}
