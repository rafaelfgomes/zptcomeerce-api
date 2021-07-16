<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
                'name' => 'Produto Teste',
                'descrption' => 'Descrição produto teste',
                'image_path' => 'images/noimage.png',
                'price' => 0.01,
                'quantity' => 10
            ],
            [ 
                'name' => 'Produto Teste 2',
                'descrption' => 'Descrição produto teste 2',
                'image_path' => 'images/noimage.png',
                'price' => 0.01,
                'quantity' => 0
            ],
        ];

        foreach ($data as $values) {
            Product::create($values);
        }
    }
}
