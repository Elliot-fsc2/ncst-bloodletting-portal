<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $departments = [
      ['name' => 'Computer Studies'],
      ['name' => 'Business Administration'],
      ['name' => 'EdPsyComm'],
      ['name' => 'Criminal Justice'],
      ['name' => 'HTMD'],
      ['name' => 'Architecture'],
      ['name' => 'Engineering'],
      ['name' => 'Accounting'],
      ['name' => 'Real Estate Management'],
    ];

    foreach ($departments as $department) {
      \App\Models\Department::create($department);
    }
  }
}
