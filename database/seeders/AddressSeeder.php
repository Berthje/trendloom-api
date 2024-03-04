<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Helpers\CsvHandler;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('data\csv\addresses.csv');
        $model = new Address();

        foreach ($data as $row) {
            $model->create([
                'address' => $row['address'],
                'city' => $row['city'],
                'state' => $row['state'],
                'zip' => $row['zip'],
                'country' => $row['country'],
            ]);
        }
    }

    private function getDataFromCsv($csv)
    {
        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
