<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/*
    pour generer des datasFakes et ne pas les ecrire à la main dans mysql on utilise les factory
    php artisan make:factory nomdetatableFactory (colé avec Factory le F en maj)
*/
class listingFactory extends Factory
{
    public function definition(): array
    {
        return [
            //pour generer des données fakes on utilise la methode fake()
            'beds' => fake()->numberBetween(1, 7),
            'baths' => fake()->numberBetween(1, 7),
            'area' => fake()->numberBetween(30, 400),
            //les methodes comme "city(), postcode(), streeetName(), numberBetween()" sont inclus de base dans laravel et c'est cool donc utilises les !!
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'street_nr' => fake()->numberBetween(10, 200),
            //50_000 se lit 50000 et 2_000_000 se lis deux millions en php
            'price' => fake()->numberBetween(50_000, 2_000_000)
        ];
    }
}
