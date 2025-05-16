<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
                DB::table('books')->insert([
                    'title' => fake()->name(),
                    'description' => fake()->text(),
                    'author' => fake()->firstName() . ' ' . fake()->lastName(),
                    'price' => fake()->numberBetween(100, 1000),
                    'image_path' => fake()->imageUrl(640, 480, 'books', true),
                ]);
            }
    }
}
