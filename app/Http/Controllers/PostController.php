<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use App\Http\CustomResponse\CustomJsonResponse;
use App\Models\ReactionPost;
use Validator;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        $posts = fractal()->collection($posts)
            ->transformWith(new PostTransformer)
            ->toArray();
        
        $data = prepareResponse($posts["data"]);
        return new CustomJsonResponse($data);
    }

    public function show(Request $request) {
        $postId = $request->id;

        $post = Post::findOrFail($postId);

        $post = fractal()->item($post)
            ->transformWith(new PostTransformer)
            ->toArray();

        $data = prepareResponse($post["data"]);
        return new CustomJsonResponse($data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string',
            'description'   => 'required|string',
            'isPublic'      => 'boolean',
            'user_id'       => 'required|integer',
        ]);

        if ($validator->fails()) {
            return failResponse($validator->errors()->toJson());
        }

        $newPost = Post::create($validator->validated());

        return response()->json($newPost)->setStatusCode(201);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'         => 'string',
            'description'   => 'string',
            'isPublic'      => 'boolean',
        ]);

        if ($validator->fails()) {
            return failResponse($validator->errors()->toJson());
        }

        $post = Post::findOrFail($request->id);
        $post->update($validator->validated());
        
        return response()->json($post->refresh())->setStatusCode(200);
    }

    public function delete(Request $request) {
        $postId = $request->id;

        $post = Post::findOrFail($postId);

        $post->delete();
        return response()->noContent();
    }

    public function handleLike(Request $request) {
        $post = Post::findOrFail($request->id);
        $user = auth()->user();
        $reaction_type = $request->reaction_type;

        $liked = ReactionPost::where([
            'post_id'   => $post->id,
            'user_id'   => $user->id,
        ])->first();

        if ($liked && $liked->reaction_type === $reaction_type) {
            $liked->delete();
        } elseif ($liked && $liked->reaction_type !== $reaction_type) {
            $liked->update([
                'reaction_type' => $reaction_type
            ]);
        } else {
            ReactionPost::create([
                'post_id'       => $post->id,
                'user_id'       => $user->id,
                'reaction_type' => $reaction_type,
            ]);
        }
        return response()->noContent()->status(200);
    }
}
