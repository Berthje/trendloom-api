<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProductStock;
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
            ProductSizeSeeder::class,
            ProductStockSeeder::class,
            BrandLanguageSeeder::class,
            ProductLanguageSeeder::class,
            CategoryLanguageSeeder::class,
            CategoryMediaSeeder::class,
        ]);
    }
}
