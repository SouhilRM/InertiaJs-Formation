<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /*
        pour generer la fakeDatas que tu as precisé dans le factory tu dois maintenant seed
    */
    public function run(): void
    {
        //premiere methode via le factory
        // \App\Models\User::factory(10)->create();

        //seconde methode sans factory tu genere de la fake datas direcrement via un tableau dans la methode create()
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\listing::factory(20)->create();//ici on va en generer 20
    }
}
// pour seed la commende ==> php artisan db:seed
// pour generer dautre datas (rafraichir la BDD) ==> php artisan migrate:refresh --seed