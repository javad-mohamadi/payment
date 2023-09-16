<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Card;
use App\Models\Config;
use App\Models\Account;
use App\Enum\ConfigEnum;
use App\Enum\CardTypeEnum;
use App\Enum\CurrencyEnum;
use App\Enum\AccountTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'number'   => 39098000112460000,
            'user_id'  => $superAdmin->id,
            'balance'  => 0,
            'currency' => CurrencyEnum::CURRENCY_IRR->value,
            'type'     => AccountTypeEnum::SYSTEM->value,
        ]);


        $firstUserAccount = Account::factory()->create([
            'number'   => 39098000112460181,
            'user_id'  => $firstUser->id,
            'balance'  => 1000000000,
            'currency' => CurrencyEnum::CURRENCY_IRR->value,
            'type'     => AccountTypeEnum::SHORT_TERM->value,
        ]);

        $secondUserAccount = Account::factory()->create([
            'number'   => 39098000112460182,
            'user_id'  => $secondUser->id,
            'balance'  => 1000,
            'currency' => CurrencyEnum::CURRENCY_IRR->value,
            'type'     => AccountTypeEnum::SHORT_TERM->value,
        ]);

        Card::factory()->create([
            'number'      => 5022291085189544,
            'type'        => CardTypeEnum::CREDIT_CARD->value,
            'account_id'  => $adminAccount->id,
            'expire_date' => now()->setDate(2028, 01, 01),
        ]);

        Card::factory()->create([
            'number'                 => 5022291085189000,
            'type'                   => CardTypeEnum::CREDIT_CARD->value,
            'account_id'             => $firstUserAccount->id,
            'static_second_password' => Hash::make(123456),
            'expire_date'            => now()->setDate(2028, 01, 01),
        ]);

        Card::factory()->create([
            'number'                 => 5022291045501111,
            'type'                   => CardTypeEnum::CREDIT_CARD->value,
            'account_id'             => $secondUserAccount->id,
            'static_second_password' => Hash::make(123456),
            'expire_date'            => now()->setDate(2028, 01, 01),
        ]);

        Config::factory()->create([
            'key'   => ConfigEnum::DEPOSIT->value,
            'value' => 'Amount:%s IRR was deposited to your account:%s on Date:%s Time:%s',
            'group' => ConfigEnum::PAYMENT->value,
        ]);

        Config::factory()->create([
            'key'   => ConfigEnum::WITHDRAW->value,
            'value' => 'Amount:%s IRR  was withdrawn from your account:%S on Date:%s Time:%s',
            'group' => ConfigEnum::PAYMENT->value,
        ]);

        Config::factory()->create([
            'key'   => ConfigEnum::TWO_FACTOR->value,
            'value' => "one-time code:%s withdraw from this account:%s Date:%s Time:%s",
            'group' => ConfigEnum::PAYMENT->value,
        ]);

        DB::table('oauth_clients')->where('id', env('CLIENT_WEB_ADMIN_ID'))->update([
            'secret' => env('CLIENT_WEB_ADMIN_SECRET')
        ]);
    }
}
