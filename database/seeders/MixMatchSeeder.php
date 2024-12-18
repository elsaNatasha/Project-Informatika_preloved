<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MixMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mix_match_recommendations')->insert([
            [
                'id' => 1,
                'top_id' => 24,
                'bottom_id' => 20,
                'created_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
                'updated_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
            ],
            [
                'id' => 2,
                'top_id' => 21,
                'bottom_id' => 19,
                'created_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
                'updated_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
            ],
            [
                'id' => 3,
                'top_id' => 29,
                'bottom_id' => 19,
                'created_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
                'updated_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
            ],
            [
                'id' => 4,
                'top_id' => 16,
                'bottom_id' => 20,
                'created_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
                'updated_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
            ],
            [
                'id' => 5,
                'top_id' => 12,
                'bottom_id' => 18,
                'created_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
                'updated_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
            ],
            [
                'id' => 6,
                'top_id' => 16,
                'bottom_id' => 19,
                'created_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
                'updated_at' => Carbon::create(2024, 12, 13, 14, 34, 7),
            ],
        ]);
    }
}
