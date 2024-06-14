<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
