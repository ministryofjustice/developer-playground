<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tool_id' => Tool::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'action' => 'create',
            'detail' => 'Tool created',
            'origin' => 'user'
        ];
    }
}
