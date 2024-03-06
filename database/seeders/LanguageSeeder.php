<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Helpers\CsvHandler;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\languages.csv');
        $model = new Language();

        foreach ($data as $row) {
            $model->create([
                'name' => $row['name'],
                'code' => $row['code'],
            ]);
        }
    }

    private function getDataFromCsv($csv){
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
