<?php

use App\Models\Product;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        $product1 = Product::create([
            'parent_id' => null,
            'name' => 'Рабочая тетрадь',
            'cost' => $this->genCost(),
        ]);

        $product2 = Product::create([
            'parent_id' => null,
            'name' => 'Ручка',
            'cost' => $this->genCost(),
        ]);

        Product::create([
            'parent_id' => null,
            'name' => 'Карандаш',
            'cost' => $this->genCost(),
        ]);

        Product::create([
            'parent_id' => $product1->getId(),
            'name' => 'в клеточку',
            'cost' => $this->genCost(),
        ]);

        Product::create([
            'parent_id' => $product1->getId(),
            'name' => 'в строчку',
            'cost' => $this->genCost(),
        ]);

        Product::create([
            'parent_id' => $product2->getId(),
            'name' => 'синия',
            'cost' => $this->genCost(),
        ]);

        Product::create([
            'parent_id' => $product2->getId(),
            'name' => 'красная',
            'cost' => $this->genCost(),
        ]);
    }

    private function genCost()
    {
        return round((1 + mt_rand() / mt_getrandmax() * (100 - 1)), 2);
    }
}

