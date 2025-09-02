<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'loan_interest_rate' => 5.00,
            'virtual_card_fee'   => 5.00,
            'physical_card_fee'  => 15.00,
        ]);
    }
}
