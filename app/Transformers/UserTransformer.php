<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $model = User::class;

    public function transform(User $user) {
        $transform = [
            "id"            => (int) $user->id,
            "name"          => $user->name,
            "email"         => $user->email,
        ];

        return $transform;
    }
}
