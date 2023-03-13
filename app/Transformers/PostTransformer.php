<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $model = Post::class;

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    // protected $defaultIncludes = array('user');
    protected array $defaultIncludes = ['user'];
    /**
     * Transform the Post entity
     * 
     * @param Post::class $model
     * 
     * @return array
     */
    public function transform(Post $post) {
        $transform = [
            'id'            => (int) $post->id,
            'title'         => $post->title,
            'description'   => $post->description,
            'isPublic'      => (Boolean)$post->isPublic,
            'created_at'    => date('H:i:s d/m/Y', strtotime($post->created_at)),
            'updated_at'    => date('H:i:s d/m/Y', strtotime($post->updated_at)),
        ];

        return $transform;
    }

    public function includeUser(Post $post) {
        $user = $post->user;

        return $this->item($user, new UserTransformer);
    }
}
