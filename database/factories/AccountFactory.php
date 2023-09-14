<?php

namespace Database\Factories;

use App\Enum\CurrencyEnum;
use App\Enum\AccountTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_number' => fake()->creditCardNumber,
            'balance'        => 0,
            'currency'       => CurrencyEnum::CURRENCY_IRR,
            'account_type'   => AccountTypeEnum::SHORT_TERM,
        ];
    }
}
