<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductSize;
use App\Helpers\CsvHandler;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\product_sizes.csv');
        $model = new ProductSize();

        foreach ($data as $row) {
            $model->create([
                'product_id' => $row['product_id'],
                'size' => $row['size'],
            ]);
        }
    }

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
