<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['ime'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
