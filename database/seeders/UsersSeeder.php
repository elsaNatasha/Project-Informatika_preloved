<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'admin',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => '$2y$10$4QG29jpvw.MxwwS73c0kvOvJesG/hvki/ZCspWMT..oQBa7s0oPNK',
                    'phone' => '082144946147',
                    'address' => 'paingan',
                    'role' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'buyer',
                    'username' => 'buyer',
                    'email' => 'buyer@gmail.com',
                    'password' => '$2y$10$aJXVJjUoeooUbu.6XPft9OpTE2RIACXNCA0v1EDRdJe/yi27hOGJ6',
                    'phone' => '082144946147',
                    'address' => 'paingan',
                    'role' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'buyer2',
                    'username' => 'buye2',
                    'email' => 'buyer2@gmail.com',
                    'password' => '$2y$10$aJXVJjUoeooUbu.6XPft9OpTE2RIACXNCA0v1EDRdJe/yi27hOGJ6',
                    'phone' => '082144946147',
                    'address' => 'paingan',
                    'role' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]
        );
    }
}
