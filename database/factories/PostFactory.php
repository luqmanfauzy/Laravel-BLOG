<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "categories_id"=> $this->faker->numberBetween(1,4),
            "users_id"=> $this->faker->numberBetween(1,5),
            'title' => implode(' ', $this->faker->words(rand(3, 5), false)),
            'slug' => implode('-', array_map(fn() => $this->faker->regexify('[a-z]{4,7}'), range(1, $this->faker->numberBetween(3, 5)))),
            'excerpt' => implode('-', array_map(function() {
                return $this->faker->lexify(str_repeat('?', rand(4, 7)));
            }, range(1, rand(15, 23)))),
            'body' => $this->faker->paragraphs(rand(2, 4), true),
        ];

        // return [
        //     "categories_id" => $this->faker->numberBetween(1,4),
        //     "users_id" => 7,
        //     "title" => implode(' ', $this->faker->words(rand(3, 5), false)),
        //     "slug" => implode('-', array_map(fn() => $this->faker->regexify('[a-z]{4,7}'), range(1, $this->faker->numberBetween(3, 5)))),
        //     'excerpt' => implode('-', array_map(function() {
        //         return $this->faker->lexify(str_repeat('?', rand(4, 7)));
        //     }, range(1, rand(15, 23)))),
        //     'body' => $this->faker->paragraphs(rand(2, 4), true),
        // ];
    }
}
