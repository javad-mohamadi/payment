<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'mobile' => '09359341940',
        ]);
        User::factory()->create([
            'mobile' => '09213910615',
        ]);
    }
}
