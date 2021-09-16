<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Customer;
use Database\Factories\AgencyFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//        Agency::factory()->count(6)->create();
//        Customer::factory()->count(6)->create();
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
            SettingsSeeder::class,
//            ServicesSeeder::class,
        ]);
    }
}
