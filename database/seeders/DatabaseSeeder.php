<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'rol' => 1,
        ]);
        User::factory(10)->create();

        PenaltyCategory::factory(1)->create();

        TicketCategory::factory(1)->create([
            'name' => 'Falta de agua'
        ]);

        TicketCategory::factory(1)->create([
            'name' => 'Cortes de luz'
        ]);

        TicketCategory::factory(1)->create([
            'name' => 'Escandalos de vecinos'
        ]);

        TicketCategory::factory(1)->create([
            'name' => 'Robos'
        ]);

        TicketCategory::factory(1)->create([
            'name' => 'Vandalismo'
        ]);

        TicketCategory::factory(1)->create([
            'name' => 'Basura en las calles'
        ]);

        TicketCategory::factory(1)->create([
            'name' => 'Vehículos mal estacionados'
        ]);

        

        House::factory(30)->create();

        Penalty::factory(20)->create();
        Ticket::factory(20)->create();
    }
}
