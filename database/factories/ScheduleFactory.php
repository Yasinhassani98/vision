<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'level_id'=>Level::inRandomOrder()->first()->id,
            'title'=>$this->faker->words(2,true),
            'type'=>$this->faker->randomElement(['exam','activity','daily']),
            'description'=>$this->faker->sentence(5),
            'start_time'=>$this->faker->dateTimeBetween('-1 month', '+1 hours'),
            'end_time'=>$this->faker->dateTimeBetween('start_time', '+1 hours'),
        ];
    }
}
