<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password', //plus besoin de le hacher le mutators/accessors s'en charge automatiquement pour nous
            'is_admin' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test2 User2',
            'email' => 'test2@example.com',
            'password' => 'password',
        ]);

        \App\Models\listing::factory(10)->create([
            'by_user_id' => 1,
        ]);

        \App\Models\listing::factory(10)->create([
            'by_user_id' => 2,
        ]);
    }
}
// pour seed la commende ==> php artisan db:seed
// pour generer dautre datas (rafraichir la BDD) ==> php artisan migrate:refresh --seed