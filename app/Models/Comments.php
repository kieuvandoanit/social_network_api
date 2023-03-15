<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'commentable_type',
        'commentable_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function post() {
        return $this->belongsTo(Post::class, 'post_id')->withTrashed();
    }
}
