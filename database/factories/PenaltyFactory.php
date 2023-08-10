<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\Penalty;
use App\Models\PenaltyCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenaltyFactory extends Factory
{
    protected $model = Penalty::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(50),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement([1, 4]),
            'house_id' => House::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
            'penalty_category_id' => PenaltyCategory::pluck('id')->random(),
        ];
    }
}
