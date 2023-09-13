<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $firstUser = User::factory()->create([
            'mobile' => '09359341940',
        ]);

        $secondUser = User::factory()->create([
            'mobile' => '09213910615',
        ]);

        Account::factory()->create([
            'account_number' => 39098000112460181,
            'user_id'        => $firstUser->id,
            'balance'        => 100000,
            'currency'       => 'IRR',
            'account_type'   => 'SAVING',
        ]);

        Account::factory()->create([
            'account_number' => 39098000112460182,
            'user_id'        => $secondUser->id,
            'balance'        => 0,
            'currency'       => 'IRR',
            'account_type'   => 'SAVING',
        ]);
    }
}
