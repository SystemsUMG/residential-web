<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(50),
            'status' => $this->faker->randomElement(['generated', 'assigned', 'in_progress', 'finalized']),
            'house_id' => House::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
            'ticket_category_id' => TicketCategory::pluck('id')->random(),
        ];
    }
}
