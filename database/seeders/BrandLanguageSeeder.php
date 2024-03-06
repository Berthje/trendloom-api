<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrandLanguage;
use App\Helpers\CsvHandler;

class BrandLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\brands_language.csv');
        $model = new Brand();

        foreach ($data as $row) {
            $model->create([
                'brand_id' => $row['brand_id'],
                'language_id' => $row['language_id'],
                'name' => $row['name'],
                'description' => $row['description'],
            ]);
        }
    }

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
