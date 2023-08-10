<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    protected $model = House::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->address,
            'active' => $this->faker->numberBetween(1, 0),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
