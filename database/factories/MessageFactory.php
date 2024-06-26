<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $conversation = Conversation::all()->random();

        return [
            'conversation_id' => $conversation->id,
            'content' => $this->faker->sentence(),
            'response' => $this->faker->sentence(),
        ];
    }
}

