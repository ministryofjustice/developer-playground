<?php

namespace Database\Factories;

use App\Models\Licence;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

class LicenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Licence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tool_id' => Tool::factory()->create()->id,
            'description' => $this->faker->sentence,
            'user_limit' => 1000,
            'users_current' => 800,
            'annual_cost' => $this->faker->numberBetween(200, 240000),
            'currency' => 'GB',
            'cost_per_user' => 10.99,
            'start' => '2021-09-12 00:00:00',
            'stop' => '2022-09-11 23:59:59'
        ];
    }
}
