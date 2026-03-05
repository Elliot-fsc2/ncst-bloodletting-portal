<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      // 'hospital_id' => Hospital::factory(),
      'donor_name' => fake()->firstName(),
      'donor_email' => fake()->email(),
      'form_data' => [
        'age' => fake()->numberBetween(18, 65),
        'blood_type' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
        'last_donation_date' => fake()->date(),
      ],
    ];
  }
}
