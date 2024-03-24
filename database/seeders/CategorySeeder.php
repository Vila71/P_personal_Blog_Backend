<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            ['category' => 'alimentacióm ancestral', 'created_at' => $now, 'updated_at' => $now],
            ['category' => 'vida saludable', 'created_at' => $now, 'updated_at' => $now],
            ['category' => 'bienestar emocional', 'created_at' => $now, 'updated_at' => $now],
            ['category' => 'movimiento en armonia', 'created_at' => $now, 'updated_at' => $now],
           
        ]);
    }
}
