<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_uid' => 't_aaaaasssss',
            'title' => 'asdwadasd',
            'initial_message' => 'aassss',
            'service_types_id' => 1,
            'status_id' => 1,
            'created_by' => 1,
        ];
    }
}