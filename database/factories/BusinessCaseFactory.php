<?php

namespace Database\Factories;

use App\Models\BusinessCase;
use App\Models\Licence;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessCaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessCase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(3);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'link' => $this->faker->url,
            'text' => $this->faker->sentences(5, true),
            'tool_id' => Tool::factory()->create()->id,
            'licence_id' => Licence::factory()->create()->id
        ];
    }
}
