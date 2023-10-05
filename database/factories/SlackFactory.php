<?php

namespace Database\Factories;

use App\Models\Slack;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SlackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slack::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name =  $this->faker->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'webhook_url' => $this->faker->url(),
            'channel' => '#channel'
        ];
    }
}
