<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 2, 'name' => 'Kemeja', 'status' => 1, 'created_at' => '2024-11-16 09:35:08', 'updated_at' => '2024-11-16 09:35:08'],
            ['id' => 4, 'name' => 'Dress', 'status' => 1, 'created_at' => '2024-11-16 09:44:33', 'updated_at' => '2024-11-16 09:44:33'],
            ['id' => 5, 'name' => 'Kaos', 'status' => 1, 'created_at' => '2024-11-16 09:45:27', 'updated_at' => '2024-11-18 03:34:50'],
            ['id' => 6, 'name' => 'Blouse', 'status' => 1, 'created_at' => '2024-11-23 07:09:12', 'updated_at' => '2024-11-23 07:09:12'],
            ['id' => 7, 'name' => 'Celana pendek', 'status' => 1, 'created_at' => '2024-11-23 07:10:03', 'updated_at' => '2024-11-23 07:10:13'],
            ['id' => 8, 'name' => 'Celana panjang', 'status' => 1, 'created_at' => '2024-11-23 07:10:26', 'updated_at' => '2024-11-23 07:10:26'],
            ['id' => 9, 'name' => 'Legging', 'status' => 1, 'created_at' => '2024-11-23 07:10:35', 'updated_at' => '2024-11-23 07:10:35'],
            ['id' => 10, 'name' => 'Cardigan', 'status' => 1, 'created_at' => '2024-11-23 07:10:47', 'updated_at' => '2024-11-23 07:10:47'],
            ['id' => 11, 'name' => 'Blazer', 'status' => 1, 'created_at' => '2024-11-23 07:11:16', 'updated_at' => '2024-11-23 07:11:16'],
            ['id' => 12, 'name' => 'Rok', 'status' => 1, 'created_at' => '2024-11-23 09:59:23', 'updated_at' => '2024-11-23 09:59:23'],
        ];

        Category::insert($categories);
    }
}
