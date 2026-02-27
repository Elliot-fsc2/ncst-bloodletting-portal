<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::create(['name' => 'Red Cross']);
        Hospital::create(['name' => 'Tanza Specialists Medical Center']);
        Hospital::create(['name' => 'Emilio Aguinaldo Medical Center']);
        Hospital::create(['name' => 'Veterans Memorial Medical Center']);
        Hospital::create(['name' => 'De La Salle University Medical Center']);
    }
}
