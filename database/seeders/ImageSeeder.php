<?php

namespace Database\Seeders;

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
                "link"      => "abc.com",
                "post_id"   => 1
            ],
            [
                "link"      => "cdef.com",
                "post_id"   => 2
            ],
        ]);
    }
}
