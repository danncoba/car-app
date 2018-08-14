<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Category;
use Illuminate\Support\Facades\DB;
use Sunra\PhpSimple\HtmlDomParser;

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

    public function loadExternal()
    {
        $url = "https://www.polovniautomobili.com/auto-oglasi/pretraga?brand=audi&model=&price_from=40000&price_to=&year_from=&year_to=&door_num=&submit_1=&without_price=1&date_limit=&showOldNew=all&modeltxt=&engine_volume_from=&engine_volume_to=&power_from=&power_to=&mileage_from=&mileage_to=&emission_class=&seat_num=&wheel_side=&registration=&country=&city=&page=&sort=";
        $html = HtmlDomParser::file_get_html($url, false, null, 0);
        $cars = $this->getAllCars($html);
        return $cars;
    }

    private function getAllCars($dom)
    {
        $allCars = array();
        foreach ($dom->find('article.single-classified') as $car)
        {
            $singleCar = [];

            $images = $car->find('img');
            if($images[0]->hasAttribute('data-src'))
            {
                $singleCar['slika'] = $images[0]->getAttribute('data-src');
            }
            else
            {
                $singleCar['slika'] = $images[0]->getAttribute('src');
            }
            $price = $car->find('span.price');
            $singleCar['ime'] = preg_replace("/\s+/", " ", $car->firstChild()->firstChild()->firstChild()->text());
            $singleCar['cena'] = $price[0]->text();
            array_push($allCars, $singleCar);
        }
        return $allCars;
    }
}
