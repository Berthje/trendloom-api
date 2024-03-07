<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Helpers\CsvHandler;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\order_items.csv');
        $model = new OrderItem();

        foreach ($data as $row) {
            $model->create([
                'order_id' => $row['order_id'],
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity'],
                'price' => $row['price'],
            ]);
        }
    }
}
