<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allCategories = [
            ['ime' => 'Audi'],
            ['ime' => 'Mercedes'],
            ['ime' => 'Opel'],
            ['ime' => 'Bmw'],
            ['ime' => 'Alfa Romeo'],
            ['ime' => 'Citroen'],
            ['ime' => 'Peugeot'],
            ['ime' => 'VW'],
            ['ime' => 'Aston Martin']
        ];

        foreach ($allCategories as $category)
        {
            Category::create($category);
        }
    }
}
