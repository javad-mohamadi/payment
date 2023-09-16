<?php

namespace Database\Factories;

use App\Enum\ConfigEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'key'   => $this->faker->unique()->word,
            'value' => $this->faker->word,
            'group' => ConfigEnum::DEPOSIT->value,
        ];
    }
}
