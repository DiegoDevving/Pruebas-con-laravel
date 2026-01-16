<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario de prueba cada que se ejecuten migraciones
        // php artisan migrate:fresh --seed
        User::factory()->create([
            'name' => 'Diego',
            'email' => 'diego.zavaleta@tecdesoftware.edu.mx',
            'password' => bcrypt('12345678'),
            'id_number' => 123456789,
            'phone' => '5555 555 5555',
            'address' => 'Calle 67, colonia 420'
        ])->assignRole('Doctor');
    }
}
