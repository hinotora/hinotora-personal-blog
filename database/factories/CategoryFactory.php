<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(2);
        $slug = Str::of($name)->slug('-');

        return [
            'name'=> $name,
            'description' => $this->faker->sentence(10),
            'slug'=> $slug,
            'preview'=> $this->faker->imageUrl(728, 200, 'animals', true),
        ];
    }
}
