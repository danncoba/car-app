<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['ime', 'kilometraza', 'cena', 'slika', 'category_id'];
}
