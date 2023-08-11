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

        PenaltyCategory::factory(4)->create();
        TicketCategory::factory(4)->create();

        House::factory(30)->create();

        Penalty::factory(20)->create();
        Ticket::factory(20)->create();
    }
}
