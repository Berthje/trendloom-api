<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\ProductLanguage;
use App\Helpers\CsvHandler;

class ProductLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\product_languages.csv');
        $model = new ProductLanguage();

        foreach ($data as $row) {
            $model->create([
                'product_id' => $row['product_id'],
                'language_id' => $row['language_id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'tags' => $row['tags'],
            ]);
        }
    }
}
