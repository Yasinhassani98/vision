<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parent_id'=>User::where('role','parent')->inRandomOrder()->first()->id,
            'amount'=>$this->faker->numberBetween(100,1000),
            'status'=>$this->faker->randomElement(['confirmed','partly','failed','pending']),
            'payment_date'=>$this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
