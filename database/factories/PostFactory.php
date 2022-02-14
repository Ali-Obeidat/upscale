<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> User::factory()->make(),
            'title'=>$this->faker->sentence(),
            'post_img'=>$this->faker->imageUrl(900, 300),
            'body'=>$this->faker->paragraph(),
        ];
    }
}
