<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductLanguage;
use App\Helpers\CsvHandler;

class ProductLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\product_languages.csv');
        $model = new BrandLanguage();

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

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
