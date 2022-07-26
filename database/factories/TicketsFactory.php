<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketsFactory extends Factory
{
    protected $model = \App\Models\Tickets::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_uid' => 't_'.uniqid(),
            'title' => $this->faker->word(),
            'initial_message' => $this->faker->sentence(),
            'service_types_id' => 1,
            'status_id' => 1,
            'created_by' => 1,
        ];
    }
}