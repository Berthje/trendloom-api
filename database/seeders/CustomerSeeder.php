<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Role;
use App\Helpers\CsvHandler;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\customers.csv');
        $model = new Customer();

        $userRole = Role::where('name', 'user')->first();
        $adminRole = Role::where('name', 'admin')->first();

        foreach ($data as $row) {
            $customer = $model->create([
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'password' => $row['password'],
                'address_id' => $row['address_id'],
            ]);

            $customer->roles()->attach($userRole);

            if ($row['email'] === 'laytonbrth@gmail.com') {
                $customer->roles()->attach($adminRole);
            }
        }
    }
}
