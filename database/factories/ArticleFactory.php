<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'date' => now(), // Utiliza la fecha y hora actual
            'id_category' =>Category::all()->random()->id,
            'image' =>$this->faker->url(),
        ];
    }
}
