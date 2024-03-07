<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Helpers\CsvHandler;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\roles.csv');
        $model = new Role();

        foreach ($data as $row) {
            $model->create([
                'name' => $row['name'],
            ]);
        }
    }
}
