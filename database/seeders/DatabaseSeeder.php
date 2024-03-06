<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LanguageSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            AddressSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            BrandLanguageSeeder::class,
            ProductLanguageSeeder::class,
        ]);
    }
}
