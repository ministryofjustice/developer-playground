<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name =  $this->faker->name();
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'slack' => $slug,
            'slug' => $slug
        ];
    }
}
