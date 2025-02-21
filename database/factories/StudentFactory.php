<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->words(1, true),
            'last_name' => $this->faker->words(1, true),
            'level_id' => Level::inRandomOrder()->first()->id, 
            'parent_id' => User::where('role', 'parent')->inRandomOrder()->first()->id,
            'supervisor_id' => User::where('role', 'supervisor')->inRandomOrder()->first()->id, 
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address,
            'bio' => $this->faker->sentence(10), 
            'DOB' => $this->faker->date('Y-m-d'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Student $student) {
            $teachers = User::where('role', 'teacher')
                ->inRandomOrder()
                ->take(rand(1, 3))
                ->get();

            $student->teachers()->attach($teachers->pluck('id'));
        });
    }
}
