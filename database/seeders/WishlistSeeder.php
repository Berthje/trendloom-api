<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Wishlist;
use App\Helpers\CsvHandler;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CsvHandler $csvHandler): void
    {
        $data = $csvHandler->getDataFromCsv('data\csv\wishlists.csv');
        $model = new Wishlist();

        foreach ($data as $row) {
            $model->create([
                'customer_id' => $row['customer_id'],
                'product_id' => $row['product_id'],
            ]);
        }
    }
}
