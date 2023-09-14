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
            'card_number'     => fake()->creditCardNumber,
            'card_type'       => CardTypeEnum::CREDIT_CARD,
            'cvv2'            => rand('0000','9999'),
            'expiration_date' => Carbon::now()->addYears(5),
        ];
    }
}
