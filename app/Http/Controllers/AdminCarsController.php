<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class AdminCarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function approve($car)
    {
        $c = Car::find($car);
        $c->odobren = true;
        $c->save();
        return redirect()->route('home');
    }
}
