<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;
use App\Models\Specialty;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(29,55),
            'phone' =>$this->faker->randomNumber(8),
            'proEmail' => $this->faker->safeEmailDomain(),
            'description' => $this->faker->sentence(10),
            'specialty_id' => Specialty::factory(),
            'picture' => $this->faker->filePath(),
            'user_id' => User::factory(['role' => '2']),
            'department_id' =>  Department::factory(),

        ];
    }
}
