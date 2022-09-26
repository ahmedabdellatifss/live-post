<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postId = FactoryHelper::getRandomModelId(Post::class);

        return [
            'body' =>[],
            'user_id' => FactoryHelper::getRandomModelId(User::class),
            'post_id' =>FactoryHelper::getRandomModelId(Post::class)
        ];

        // $count = Post::query()->count();
        // if($count === 0)
        // {
        //     $postId = Post::factory()->create()->id;
        // }else{
        //     $postId = rand(1 , $count);
        // }
        // return [
        //     'body' =>[],
        //     'user_id' =>1,
        //     'post_id' => $postId,
        // ];
    }
}
