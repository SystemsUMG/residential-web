<?php

namespace Database\Factories;

use App\Enums\TypeOfKinship;
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
                'relationship' => fake()->randomElement([
                    TypeOfKinship::Padre,
                    TypeOfKinship::Madre,
                    TypeOfKinship::Hijo,
                    TypeOfKinship::Hija,
                    TypeOfKinship::Hermano,
                    TypeOfKinship::Hermana,
                    TypeOfKinship::Abuelo,
                    TypeOfKinship::Abuela,
                    TypeOfKinship::Nieto,
                    TypeOfKinship::Nieta,
                    TypeOfKinship::Tio,
                    TypeOfKinship::Tia,
                    TypeOfKinship::Sobrino,
                    TypeOfKinship::Sobrina,
                    TypeOfKinship::PrimoPrima,
                    TypeOfKinship::EsposoMarido,
                    TypeOfKinship::EsposaMujer,
                    TypeOfKinship::Suegro,
                    TypeOfKinship::Suegra,
                    TypeOfKinship::Yerno,
                    TypeOfKinship::Nuera,
                    TypeOfKinship::Cuñado,
                    TypeOfKinship::Cuñada,
                    TypeOfKinship::Padrastro,
                    TypeOfKinship::Madrastra,
                    TypeOfKinship::Hijastro,
                    TypeOfKinship::Hijastra,
                    TypeOfKinship::MedioHermano,
                    TypeOfKinship::MediaHermana,
                    TypeOfKinship::Padrino,
                    TypeOfKinship::Madrina,
                ]),
            ];
        }
        return [
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'password' => Hash::make('password'),
            'family_list' => $familyList,
        ];
    }
}
