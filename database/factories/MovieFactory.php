<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actor_details =  Actor::all()->random();
        return [
            'title'=> fake()->sentence(3),
            'release_year'=> fake()->year(),
            'director_name'=> fake()->name(),
            'actor_id'=> $actor_details->id,
        ];
    }
}
