<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $all_categories = Category::select('id')->get();
        $categories = [];

        foreach ($all_categories as $key => $category) {
            $categories[$key] = $category->id;
        }

        return [
            'title' => $this->faker->sentence(10),
            'body' => $this->faker->text(1500),
            'category_id' => Arr::random($categories),
        ];
    }
}
