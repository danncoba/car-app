<?php

use Illuminate\Database\Seeder;
use App\Car;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allCars = [
            ['ime' => 'Audi A3 2004 Godiste', 'cena' => 9800, 'opis' => 'Audi A3 2004 godiste ekstra stanje', 'godiste' => 2004, 'kilometraza' => 265000, 'category_id' => 1, 'user_id' => 2],
            ['ime' => 'Mercedes E 220d 2005 godiste', 'cena' => 16600, 'opis' => 'Mercedes E klasa 220 d 110kw', 'godiste' => 2005, 'kilometraza' => 210000, 'category_id' => 2, 'user_id' => 3],
            ['ime' => 'Opel astra g 2007 godiste ekstra stanje', 'cena' => 8700, 'opis' => 'Opel astra g 2007 110kw', 'godiste' => 2007, 'kilometraza' => 260000, 'category_id' => 3, 'user_id' => 2],
        ];
        foreach($allCars as $car)
        {
            Car::create($car);
        }
    }

//$table->string('ime')->nullable(false);
//$table->decimal('cena')->nullable(false);
//$table->text('opis')->nullable(true);
//$table->bigInteger('kilometraza')->nullable(true);
//$table->string('slika')->nullable(true);
//$table->boolean('odobren')->default(false);
//$table->integer('category_id');
//$table->integer('user_id');
}
