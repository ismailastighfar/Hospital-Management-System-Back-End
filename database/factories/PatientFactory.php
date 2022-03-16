<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'age' => $this->faker->numberBetween(60,18),
            'cne' => Str::random(8),
            'address' => $this->faker->sentence(4),
            'phone' => $this->faker->randomNumber(8),
            'dateOfBirth' =>$this->faker->date(),
            'avatar' => Str::random(15),
            'user_id' => User::factory(['role' => '1']),
            'allergies' => $this->faker->text(150),
            'sickness' => $this->faker->text(150)
        ];
    }
}
