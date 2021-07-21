<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 
                'uuid' => Uuid::uuid4(),
                'quantity' => 10,
                'amount' => 500.00,
                'product_id' => 1
            ],
            [ 
                'uuid' => Uuid::uuid4(),
                'quantity' => 5,
                'amount' => 750.00,
                'product_id' => 2
            ],
        ];

        foreach ($data as $value) {
            Sale::create($value);
        }
    }
}
