<?php

namespace Database\Factories;

use App\Models\CostCentre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CostCentreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CostCentre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'number' => $this->faker->numberBetween('10000000', '900000000')
        ];
    }
}
