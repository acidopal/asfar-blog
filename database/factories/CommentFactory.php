<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\BlogPost;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        $blogPostId = BlogPost::inRandomOrder()->first()->id;

        $userId = User::inRandomOrder()->first()->id;

        return [
            'comment' => $this->faker->sentence,
            'blog_post_id' => $blogPostId,
            'user_id' => $userId,
        ];
    }

}
