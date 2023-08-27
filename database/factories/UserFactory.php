<?php

namespace Database\Factories;

use App\Enums\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {

        $familyList = [];

        for ($i = 0; $i < 10; $i++) {
            $familyList[] = [
                'name' => fake()->name(),
                'age' => fake()->numberBetween(1, 80),
                'relationship' => fake()->randomElement(['parent', 'child', 'spouse', 'sibling']),
            ];
        }
        return [
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement([UserType::Admin, UserType::Resident, UserType::Guard, UserType::Operator]),
            'family_list' => $familyList,
        ];
    }
}
