<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'organisation_id' => Organisation::factory()->create()->id
        ];
    }
}
