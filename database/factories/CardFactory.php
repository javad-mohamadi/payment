<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Enum\CardTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number'      => fake()->creditCardNumber,
            'type'        => CardTypeEnum::CREDIT_CARD->value,
            'cvv2'        => '9999',
            'expire_date' => Carbon::now()->addYears(5),
        ];
    }
}
