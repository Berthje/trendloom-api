<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductStock;
use App\Helpers\CsvHandler;

class ProductStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\product_stock.csv');
        $model = new ProductStock();

        foreach ($data as $row) {
            $model->create([
                'product_id' => $row['product_id'],
                'size_id' => $row['size_id'],
                'quantity_in_stock' => $row['quantity_in_stock'],
            ]);
        }
    }
}
