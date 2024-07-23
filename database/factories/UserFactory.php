<?php

namespace Database\Factories;

use App\Constants\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => null,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'type' => UserType::TYPE_ADMIN,
        ];
    }

    /**
     * Indicate that the model's type should be customer.
     */
    public function customer(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => UserType::TYPE_NORMAL,
        ]);
    }
}
