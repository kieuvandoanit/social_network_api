<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "content"   => 'string|required'
        ]);
        $post_id = (int) $request->id;
        $post = Post::findOrFail((int) $request->id);
        return $post;
    }
}
