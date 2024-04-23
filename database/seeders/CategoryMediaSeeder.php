<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\CategoryMedia;
use App\Helpers\CsvHandler;

class CategoryMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\category_media.csv');
        $model = new CategoryMedia();

        foreach ($data as $row) {
            $model->create([
                'category_id' => $row['category_id'],
                'image_url' => $row['image_url'],
            ]);
        }
    }
}
