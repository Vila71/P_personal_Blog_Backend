<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define la cantidad de artículos que quieres crear
        $numArticles = 10;

        // Utiliza la factory para crear los artículos
        Article::factory($numArticles)->create();
    }
}

