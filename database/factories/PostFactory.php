<?php

namespace farazasifali\Larapress\Database\Factories;

use farazasifali\Larapress\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'body' => $this->faker->paragraph,
            'extra' => json_encode(['test' => '']),
        ];
    }
}
