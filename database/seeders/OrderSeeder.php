<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Helpers\CsvHandler;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\orders.csv');
        $model = new Order();

        foreach ($data as $row) {
            $model->create([
                'customer_id' => $row['customer_id'],
                'address_id' => $row['address_id'],
                'coupon_id' => $row['coupon_id'],
                'order_date' => $row['order_date'],
                'status' => $row['status'],
                'amount_products' => $row['amount_products'],
                'total_price' => $row['total_price'],
                'payment_method' => $row['payment_method'],
                'shipping_method' => $row['shipping_method'],
                'tracking_number' => $row['tracking_number'],
            ]);
        }
    }
}
