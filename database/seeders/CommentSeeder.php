<?php

namespace Database\Seeders;

use App\Models\Post;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                "content"           => "Bai post nay hay qua",
                "commentable_type"  => Post::class,
                "commentable_id"    => 1,
                "user_id"           => 2
            ],
            [
                "content"           => "Ban noi rat dung, tang ban 1 like",
                "commentable_type"  => Post::class,
                "commentable_id"    => 1,
                "user_id"           => 3
            ],
            [
                "content"           => "Noi dung nham nhi",
                "commentable_type"  => Post::class,
                "commentable_id"    => 1,
                "user_id"           => 1
            ],
            [
                "content"           => "Ban la tam guong sang cho moi nguoi.",
                "commentable_type"  => Post::class,
                "commentable_id"    => 2,
                "user_id"           => 1
            ],
            [
                "content"           => "Minh se hoc tap theo ban",
                "commentable_type"  => Post::class,
                "commentable_id"    => 2,
                "user_id"           => 2
            ],
        ]);
    }
}
