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
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Natalia',
                'username' => 'test',
                'email' => 'natalia@gmail.com',
                'password' => '$2y$10$byqIHAfwobclv8.GOMncuekoDZlLOdXO/8lGnfwu.N5N6kUMD5EZa',
                'created_at' => Carbon::parse('2024-11-30 10:52:01'),
                'updated_at' => Carbon::parse('2024-11-30 10:52:01'),
                'phone' => '082144946147',
                'address' => 'paingan',
            ],
            [
                'id' => 5,
                'name' => 'yulita',
                'username' => 'yulita',
                'email' => 'yulita@gmail.com',
                'password' => '$2y$12$RFOknqUAaEcnV/I/f1GG3uVu9zYtYWrwqFLwwpMyq7KpbmCH/9i72',
                'created_at' => Carbon::parse('2024-12-02 07:36:16'),
                'updated_at' => Carbon::parse('2024-12-02 07:36:16'),
                'phone' => '123123',
                'address' => 'paingan',
            ],
            [
                'id' => 6,
                'name' => 'naya',
                'username' => 'naya',
                'email' => 'naya@gmail.com',
                'password' => '$2y$12$aCi6bhRVHeGRXCGmw2CM6OgrLVws.v96nBwlIHik6UA97ghNsA8AO',
                'created_at' => Carbon::parse('2024-12-02 07:41:32'),
                'updated_at' => Carbon::parse('2024-12-02 07:41:32'),
                'phone' => '13123123',
                'address' => 'paingan',
            ],
            [
                'id' => 8,
                'name' => 'livi',
                'username' => 'livi',
                'email' => 'livi@gmail.com',
                'password' => '$2y$12$DeKydNVdHF8p4ZlffsjzPOJL9NWpr.ySsZWUHIGLoYM3Un8ZCbeFO',
                'created_at' => Carbon::parse('2024-12-02 08:26:11'),
                'updated_at' => Carbon::parse('2024-12-02 08:26:11'),
                'phone' => null,
                'address' => null,
            ],
            [
                'id' => 9,
                'name' => 'Maria',
                'username' => 'maria@gmail.com',
                'email' => 'maria@gmail.com',
                'password' => '$2y$12$KMJuKvRELdQTS8gekYXDteP4oQtDRkSe1K1S7Fm3XLJsJOmhfn90i',
                'created_at' => Carbon::parse('2024-12-04 21:39:34'),
                'updated_at' => Carbon::parse('2024-12-04 21:39:34'),
                'phone' => '1231325',
                'address' => 'paingan',
            ],
            [
                'id' => 10,
                'name' => 'elsa',
                'username' => 'elsa@gmail.com',
                'email' => 'elsa@gmail.com',
                'password' => '$2y$12$EvfUodusUTI.sMCoZx8EG.4BO44OIExxTOE0PC8cN5SzDx.MpIgl2',
                'created_at' => Carbon::parse('2024-12-04 22:11:19'),
                'updated_at' => Carbon::parse('2024-12-04 22:11:19'),
                'phone' => '12345671',
                'address' => 'Paingan',
            ],
        ]);
    }
}
