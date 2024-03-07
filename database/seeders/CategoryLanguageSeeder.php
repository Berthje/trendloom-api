<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryLanguage;
use App\Helpers\CsvHandler;

class CategoryLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\category_languages.csv');
        $model = new CategoryLanguage();

        foreach ($data as $row) {
            $model->create([
                'name' => $row['name'],
                'description' => $row['description'],
                'category_id' => $row['category_id'],
                'language_id' => $row['language_id'],
            ]);
        }
    }
}
