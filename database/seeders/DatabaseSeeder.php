<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Master;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (env('APP_ENV') != 'production') {
            User::factory(1)->create();

            User::factory()->create([
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'user@gmail.com',
            ]);
        }

        Admin::factory(1)->create();

        Master::factory(1)->create();

        $this->call([
            SettingTableSeeder::class,
        ]);
    }
}
