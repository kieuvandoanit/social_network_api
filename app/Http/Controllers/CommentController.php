<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{

    public function getAllCommentInPost(Request $request) {
        $page = $request->page ?? 0;
        $perPage = $request->perPage ?? 10;

        $comments = Comments::selectRaw("COUNT(*) OVER() as total_record, comments.*")
                    ->where('post_id', $request->id)
                    ->skip($page*$perPage)
                    ->take($perPage)
                    ->get();
        return normalResponse($comments, new CommentTranformer, $perPage, $page);

    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "content"   => 'string|required'
        ]);

        $post = Post::findOrFail((int) $request->id);
        $comment = Comments::create([
            'content'           => $request->content,
            'user_id'           => auth()->user()->id,
            'commentable_type'  => Post::class,
            'commentable_id'    => $post->id,
        ]);
        return response()->json($comment, 201);
    }

    public function delete(Request $request) {
        $comment = Comments::findOrFail((int)$request->commentId);
        $comment->delete();
        return response()->noContent();
    }
}
