<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_id'=>Student::inRandomOrder()->first()->id,
            'comment'=>$this->faker->sentence(5),
            'subject'=>$this->faker->words(1,true),
            'score' => $this->faker->numberBetween(0, 100),
        ];
    }
}
