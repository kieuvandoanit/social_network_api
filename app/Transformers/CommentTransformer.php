<?php

namespace App\Transformers;

use App\Models\Comments;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $model = Comments::class;

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected array $defaultIncludes = ['user'];
    /**
     * Transform the Comments entity
     * 
     * @param Comments::class $model
     * 
     * @return array
     */
    public function transform(Comments $comment) {
        $transform = [
            'id'            => (int) $comment->id,
            'content'         => $comment->content,
            'created_at'    => date('H:i:s d/m/Y', strtotime($comment->created_at)),
            'updated_at'    => date('H:i:s d/m/Y', strtotime($comment->updated_at)),
        ];

        return $transform;
    }

    public function includeUser(Comments $comment) {
        $user = $comment->user;

        return $this->item($user, new UserTransformer);
    }
}
