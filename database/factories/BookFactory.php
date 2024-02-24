<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title= fake()->title;
        return [
            'title' => fake()->title,
            'slug' => \Str::slug($title),
            'description' => fake()->description,
            'author' => fake()->name(),
            'genre' => fake()->genre(),
            'isbn' => fake()->isbn(),
            'publisher' => fake()->name(),
            'published' => fake()->dateTime(),
            'image' => fake()->image('public/storage/images',640,480, null, false),
        ];
    }
}
