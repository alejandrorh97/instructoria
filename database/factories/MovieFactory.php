<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Classification;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(5),
            'synopsis'=> $this->faker->sentence(20),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(1)->create()->first()->id,
            'classification_id' => Classification::factory(1)->create()->first()->id,
            'duration' => $this->faker->numberBetween(30, 300),
            'release_date' => now()
        ];
    }
}
