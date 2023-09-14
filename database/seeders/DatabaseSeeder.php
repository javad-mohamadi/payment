<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
use App\Models\Account;
use App\Enum\CurrencyEnum;
use App\Enum\CardTypeEnum;
use App\Enum\AccountTypeEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'id'     => 1,
            'name'   => 'Super Admin',
            'mobile' => '09123456789',
        ]);

        $firstUser = User::factory()->create([
            'mobile' => '09359341940',
        ]);

        $secondUser = User::factory()->create([
            'mobile' => '09213910615',
        ]);

        $adminAccount = Account::factory()->create([
            'account_number' => 39098000112460000,
            'user_id'        => $superAdmin->id,
            'balance'        => 0,
            'currency'       => CurrencyEnum::CURRENCY_IRR,
            'account_type'   => AccountTypeEnum::SAVING,
        ]);

        Card::factory()->create([
            'card_number'     => 39098000112460000,
            'card_type'       => CardTypeEnum::CREDIT_CARD,
            'account_id'      => $adminAccount->id,
            'expiration_date' => now()->setDate(2028, 01, 01),
        ]);

        Account::factory()->create([
            'account_number' => 39098000112460181,
            'user_id'        => $firstUser->id,
            'balance'        => 100000,
            'currency'       => CurrencyEnum::CURRENCY_IRR,
            'account_type'   => AccountTypeEnum::SHORT_TERM,
        ]);

        Account::factory()->create([
            'account_number' => 39098000112460182,
            'user_id'        => $secondUser->id,
            'balance'        => 0,
            'currency'       => CurrencyEnum::CURRENCY_IRR,
            'account_type'   => AccountTypeEnum::SHORT_TERM,
        ]);
    }
}
