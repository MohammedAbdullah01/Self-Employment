<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(2, true);
        $imag_array = ['photoshop.jpg', 'backend.jpg', 'frontend.png'];
        return [
            'name' =>  $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(10),
            'img' => $imag_array[rand(0, 3)],

        ];
    }
}
