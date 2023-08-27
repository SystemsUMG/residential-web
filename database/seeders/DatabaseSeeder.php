<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\House;
use App\Models\Penalty;
use App\Models\PenaltyCategory;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => UserType::Admin,
        ]);
        User::factory(10)->create();

        PenaltyCategory::factory(10)->create();

        $categories = [
            'Falta de agua',
            'Cortes de luz',
            'Escándalos de vecinos',
            'Robos',
            'Vandalismo',
            'Basura en las calles',
            'Vehículos mal estacionados'
        ];

        foreach ($categories as $category) {
            TicketCategory::factory(1)->create([
                'name' => $category
            ]);
        }

        House::factory(30)->create();

        Penalty::factory(20)->create();
        Ticket::factory(20)->create();
    }
}
