<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->dateTime(),
            'registration_token' => 'POB-25',
            'dob' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'widowed']),
            'dial_code' => $this->faker->numerify('+###'),
            'phone' => $this->faker->phoneNumber(),
            'professional_status' => $this->faker->jobTitle(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'nationality' => $this->faker->country(),
            'currency' => 'United State Dollar-USD-$',
            'account_type' => $this->faker->randomElement(['savings', 'checking']),
            'password' => Hash::make('password'),
            'account_number' => $this->faker->bankAccountNumber(),
            'balance' => $this->faker->numberBetween(0, 10000),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
