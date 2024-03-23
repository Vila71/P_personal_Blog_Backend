<?php

// ArticleFactory.php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->text(250),
            'date' => now(),
            'category_id' => Category::factory(), // Relación con CategoryFactory
            'image' => 'https://picsum.photos/200/300',
        ];
    }
}
