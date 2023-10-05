<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ToolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tool::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'approved' => 0,
            'description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'contact_id' => Contact::factory()->create()->id
        ];
    }
}
