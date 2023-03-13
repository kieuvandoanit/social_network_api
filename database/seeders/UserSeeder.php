<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "username"          => "admin",
                "name"              => "Admin",
                "email"             => "admin@gmail.com",
                "password"          =>  Hash::make("admin"),
                "department_id"     => 1,
                "status_id"         => 1,
            ],
            [
                "username"          => "kieuvandoan",
                "name"              => "Kieu Van Doan",
                "email"             => "kieuvandoan@gmail.com",
                "password"          =>  Hash::make("12341234"),
                "department_id"     => 1,
                "status_id"         => 1,
            ],
            [
                "username"          => "nguyenvana",
                "name"              => "Nguyen Van A",
                "email"             => "nguyenvana@gmail.com",
                "password"          =>  Hash::make("12341234"),
                "department_id"     => 1,
                "status_id"         => 1,
            ],
        ]);
    }
}
