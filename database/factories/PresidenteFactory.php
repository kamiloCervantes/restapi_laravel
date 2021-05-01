<?php

namespace Database\Factories;

use App\Models\Presidente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresidenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Presidente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'orden' => $this->faker->numberBetween(1,200),
        ];
    }
}
