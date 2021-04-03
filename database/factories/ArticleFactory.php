<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence(5);
        $datetime = $this->faker->date();

        $slug = Str::of($title)->slug('-');

        return [
            'user_ID'=> 1,
            'category_ID'=>$this->faker->numberBetween(1,5),
            'published'=> $this->faker->boolean,
            'title'=> $title,
            'slug'=> $slug,
            'description'=>$this->faker->paragraph(2),
            'preview'=>$this->faker->imageUrl(700, 200, 'animals', true),
            'content'=>$this->faker->randomHtml(4, 4),
            'views'=>0,
            'created_at'=>$datetime,
        ];
    }
}
