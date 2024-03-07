<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductMedia;
use App\Helpers\CsvHandler;


class ProductMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\product_media.csv');
        $model = new ProductMedia();

        foreach ($data as $row) {
            $model->create([
                'product_id' => $row['product_id'],
                'image_url' => $row['image_url'],
                'is_primary' => $row['is_primary'],
            ]);
        }
    }
}
