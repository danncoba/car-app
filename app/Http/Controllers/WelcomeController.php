<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Category;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cars = DB::table('cars')->where('odobren', '=', 1)->orderBy('created_at', 'DESC')->skip(0)->take(15)->get();
        return view('welcome', compact('cars', 'categories'));
    }

    public function search($category)
    {
        $cars = Car::all()->where('category_id', '=', $category)->where('odobren', '=', 1);
        return view('search', compact('cars'));
    }

    public function apiCars()
    {
        $cars = DB::table('cars')->where('odobren', '=', 1)->orderBy('created_at', 'DESC')->skip(0)->take(15)->get();
        $categories = Category::all();
        return response()->json(array('cars' => $cars, 'categories' => $categories));
    }

    public function searchCars($id)
    {
        $cars = DB::table('cars')->where('category_id', '=', $id)->orderBy('created_at', 'DESC')->skip(0)->take(15)->get();
        return $cars;
    }
}
