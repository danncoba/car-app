<?php

namespace App\Http\Controllers;

use App\Car;
use App\Category;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cars = Car::all();
        return view('member.cars.index', compact('cars'));
    }

    public function newAction()
    {
        $categories = Category::all();
        return view('member.cars.new', compact('categories'));
    }

    public function edit($c)
    {
        $categories = Category::all();
        $car = Car::find($c);
        return view('member.cars.edit', compact('car','categories'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'ime' => 'required|string|max:255|min:3',
            'kilometraza' => 'required|numeric',
            'cena' => 'required|numeric',
            'slika' => 'file|max:1024',
            'category_id' => 'required|numeric',
        ]);
        $ime = $request->get('ime');
        $cena = $request->get('cena');
        $kilometraza = $request->get('kilometraza');
        $slika = 'avatar.jpg';
        if($request->hasfile('slika'))
        {
            $file = $request->file('slika');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('uploads/logos/', $filename);
            $slika = $filename;
        }

        $category_id = $request->get('category_id');
        Car::create([
            'ime' => $ime,
            'cena' => $cena,
            'kilometraza' => $kilometraza,
            'slika' => $slika,
            'category_id' => $category_id,
        ]);
        return redirect()->route('member_cars');
    }

    public function update(Request $request, $c)
    {
        $this->validate($request, [
            'ime' => 'required|string|max:255|min:3',
            'kilometraza' => 'required|numeric',
            'cena' => 'required|numeric',
            'slika' => 'file|max:1024',
            'category_id' => 'required|numeric',
        ]);
        $cat = Car::find($c);
        $cat->ime = $request->get('ime');
        $cat->cena = $request->get('cena');
        $cat->kilometraza = $request->get('kilometraza');
        $cat->category_id = $request->get('category_id');
        $cat->save();
        return redirect()->route('member_cars');
    }

    public function delete($car)
    {
        $carDeleting = Car::find($car);
        $carDeleting->delete();
        return redirect()->route('categories');
    }
}
