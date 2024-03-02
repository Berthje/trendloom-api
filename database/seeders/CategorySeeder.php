<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\categories.csv');
        $model = new Category();

        foreach ($data as $row) {
            $model->create([
                'name' => $row['name'],
                'description' => $row['description'],
                'parent_category_id' => $row['parent_category_id'],
            ]);
        }
    }

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
