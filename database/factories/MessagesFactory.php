<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessagesFactory extends Factory
{
    protected $model = \App\Models\Messages::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_uid' => 't_'.uniqid(),
            'created_by' => 1,
            'created_by_type' => 0,
            'message_body' => $this->faker->sentence(),
            'order_num' => 1,
        ];
    }
}
