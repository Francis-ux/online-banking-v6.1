<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'                  => $this->faker->uuid,
            'name'                  => 'Administrator',
            'email'                 => 'admin@gmail.com',
            'password'              => Hash::make('password'),
            'status'                => true,
            'registration_token'    => 'POB-25',
            'created_at'            => now(),
            'updated_at'            => now(),
        ];
    }
}
