<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Llamar a RoleSeeder
        $this -> call([
            RoleSeeder::Class
        ]);
        // Crear un usuario de prueba cada que se ejecuten migraciones
        // php artisan migrate:fresh --seed
        User::factory()->create([
            'name' => 'Diego',
            'email' => 'diego.zavaleta@tecdesoftware.edu.mx',
            'password' => bcrypt('12345678')
        ]);
    }
}
