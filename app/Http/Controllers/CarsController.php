<?php

namespace App\Http\Controllers;

use App\Car;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $page = (int)$request->query('page');
        $skip = ($page-1)*20;
        $cars = DB::table('cars')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->skip($skip)->take(20)->get();
        $count = DB::table('cars')
            ->where('user_id', '=', Auth::user()->id)
            ->count();
        return response()->json(array('cars' => $cars, 'count' => $count));
    }

    public function newAction()
    {
        $categories = Category::all();
        return $categories;
    }

    public function uploadPicture(Request $request)
    {
        $slika = $this->uploadFile($request);
        return $slika;
    }

    public function edit($c)
    {
        $categories = Category::all();
        $car = Car::find($c);
        return ['categories' => $categories, 'car' => $car];
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'ime' => 'required|string|max:255|min:3',
            'kilometraza' => 'required|numeric',
            'godiste' => 'required|numeric',
            'cena' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);
        $ime = $request->get('ime');
        $cena = $request->get('cena');
        $godiste = $request->get('godiste');
        $opis = $request->get('opis');
        $kilometraza = $request->get('kilometraza');
        $slika = $request->get('slika');

        $category_id = $request->get('category_id');
        $car = Car::create([
            'ime' => $ime,
            'cena' => $cena,
            'kilometraza' => $kilometraza,
            'godiste' => $godiste,
            'opis' => $opis,
            'slika' => $slika,
            'category_id' => $category_id,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('member_cars');
    }

    public function update(Request $request, $c)
    {
        $this->validate($request, [
            'ime' => 'required|string|max:255|min:3',
            'kilometraza' => 'required|numeric',
            'godiste' => 'required|numeric',
            'cena' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);
        $car = Car::find($c);
        $car->ime = $request->get('ime');
        $car->cena = $request->get('cena');
        $car->godiste = $request->get('godiste');
        $car->opis = $request->get('opis');
        $car->kilometraza = $request->get('kilometraza');
        $car->slika = $request->get('slika');
        $car->category_id = $request->get('category_id');

        $car->save();
        return redirect()->route('member_cars');
    }

    public function delete($car)
    {
        $carDeleting = Car::find($car);
        $carDeleting->delete();
        return "Successfully deleted";
    }


    private function uploadFile($request)
    {
        if($request->hasfile('slika'))
        {
            $file = $request->file('slika');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('uploads/logos/', $filename);
            return '/uploads/logos/'.$filename;
        }
        return '/uploads/logos/avatar.jpg';
    }
}
