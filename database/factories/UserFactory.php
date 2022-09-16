<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'verification_token' => 'token_' . uniqid(),
            'password' => '$2y$10$LNqwhpXWB5E43ngaAxANneJ19uZycEuBf3lSMOUw8Qr94pPvWbxgG', //asdqwe123
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'has_access' => 0,
            ];
        });
    }
}
