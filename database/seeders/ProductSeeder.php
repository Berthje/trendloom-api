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
        $model = new Product();

        foreach ($data as $row) {
            $model->create([
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'sku' => $row['sku'],
                'status' => $row['status'],
                'ean_barcode' => $row['ean_barcode'],
                'brand_id' => $row['brand_id'],
                'category_id' => $row['category_id'],
            ]);
        }
    }

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
