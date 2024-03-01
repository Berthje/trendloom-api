<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Helpers\CsvHandler;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\products.csv');

        foreach ($data as $row) {
            dd($row);
        }
    }

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
