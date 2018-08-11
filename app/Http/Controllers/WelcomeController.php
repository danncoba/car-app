<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;


class WelcomeController extends Controller
{
    public function index()
    {
        $cars = Car::all()->where('odobren', '=', '1');
        return view('welcome', compact('cars'));
    }
}
