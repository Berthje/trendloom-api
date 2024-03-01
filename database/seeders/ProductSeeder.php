<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function App\Helpers\getDataFromCsv;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = getDataFromCsv(storage_path('data/csv/products.csv'));
        $model = new Product();

        foreach ($data as $row) {
            dd($row);
        }
    }
}
