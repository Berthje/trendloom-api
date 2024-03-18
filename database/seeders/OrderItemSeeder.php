<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Helpers\CsvHandler;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\order_items.csv');
        $model = new OrderItem();
        $products = Product::all()->keyBy('id');

        foreach ($data as $row) {
            $product = $products[$row['product_id']];

            $model->create([
                'order_id' => $row['order_id'],
                'product_id' => $row['product_id'],
                'product_size_id' => $row['product_size_id'],
                'product_details' => json_encode($product),
                'quantity' => $row['quantity'],
            ]);
        }
    }
}
