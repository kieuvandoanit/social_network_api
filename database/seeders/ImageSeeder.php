<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            [
                "link"              => "abc.com",
                "imageable_id"      => 1,
                "imageable_type"    => Post::class
            ],
            [
                "link"              => "cdef.com",
                "imageable_id"      => 1,
                "imageable_type"    => Post::class
            ],
            [
                "link"              => "thegioididongne.lin.com",
                "imageable_id"      => 2,
                "imageable_type"    => Post::class
            ],
            [
                "link"              => "cdef.com",
                "imageable_id"      => 2,
                "imageable_type"    => User::class,
            ],
            [
                "link"              => "cdef.com",
                "imageable_id"      => 1,
                "imageable_type"    => User::class,
            ],
        ]);
    }
}
