<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiología'],
            ['name' => 'Pediatría'],
            ['name' => 'Ginecología'],
            ['name' => 'Dermatología'],
            ['name' => 'Neurología'],
            ['name' => 'Traumatología'],
            ['name' => 'Oftalmología'],
            ['name' => 'Psiquiatría'],
        ];

        foreach ($specialties as $specialty) {
            \App\Models\Specialty::create($specialty);
        }
    }
}
