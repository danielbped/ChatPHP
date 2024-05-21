<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * O nome do modelo que esta fábrica corresponde.
     *
     * @var string
     */
    protected $model = Conversation::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário e o associa à conversa
        ];
    }
}
