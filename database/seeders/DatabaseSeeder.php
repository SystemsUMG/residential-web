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

        $penaltyCategories = [
            'Estacionamiento indebido',
            'Ruido excesivo',
            'Mascota sin correa',
            'Basura no recogida',
            'Daños a la propiedad',
            'Uso indebido de áreas comunes',
            'Incumplimiento de normativas',
            'Alteración del orden',
            'Falta de mantenimiento',
            'Mal uso de instalaciones',
        ];

        foreach ($penaltyCategories as $penaltyCategory) {
            PenaltyCategory::factory(1)->create([
                'name' => $penaltyCategory
            ]);
        }

        $ticketCategories = [
            'Problemas de fontanería',
            'Problemas eléctricos',
            'Solicitudes de mantenimiento',
            'Peticiones de mejora',
            'Consultas sobre reglas',
            'Reporte de áreas comunes',
            'Sugerencias para la comunidad',
            'Seguridad y vigilancia',
            'Inconvenientes con vecinos',
            'Otros'
        ];

        foreach ($ticketCategories as $ticketCategory) {
            TicketCategory::factory(1)->create([
                'name' => $ticketCategory
            ]);
        }

        House::factory(30)->create();

        Penalty::factory(20)->create();
        Ticket::factory(20)->create();
    }
}
