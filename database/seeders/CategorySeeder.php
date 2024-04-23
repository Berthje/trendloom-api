<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Helpers\CsvHandler;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\categories.csv');
        $model = new Category();

        // First, insert top-level categories
        foreach ($data as $row) {
            if (empty($row['parent_category_id'])) {
                $model->create([
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'parent_category_id' => null,
                ]);
            }
        }

        // Then, insert child categories
        foreach ($data as $row) {
            if (!empty($row['parent_category_id'])) {
                $model->create([
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'parent_category_id' => intval($row['parent_category_id']),
                ]);
            }
        }
    }

    private function getDataFromCsv($csv)
    {
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
