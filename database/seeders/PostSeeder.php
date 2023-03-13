<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("posts")->insert([
            [
                "title"         => "Bai viet dau tien",
                "description"   => "Mo ta bai viet dau tien ne. Toi rat yeu he thong",
                "isPublic"      => true,
                "user_id"       => 1
            ],
            [
                "title"         => "Bai viet thu 2",
                "description"   => "Mo ta bai viet thu 2 ne. Toi rat yeu he thong",
                "isPublic"      => true,
                "user_id"       => 1
            ],
            [
                "title"         => "Bai viet thu 3",
                "description"   => "Mo ta bai viet thu 3 ne. Toi rat yeu he thong",
                "isPublic"      => false,
                "user_id"       => 1
            ],
        ]);
    }
}
