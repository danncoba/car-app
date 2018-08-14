<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index()
    {
        $categories = Category::all();
        return $categories;
    }

    public function newAction()
    {
        return view('categories.new');
    }

    public function edit($category)
    {
        return Category::find($category);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'ime' => 'required|string|max:255|min:3'
        ]);
        $ime = $request->get('ime');
        $category = Category::create([
            'ime' => $ime,
        ]);
        return $category;
    }

    public function loadExternal()
    {
        $url = "https://www.polovniautomobili.com/auto-oglasi/pretraga?brand=audi&model=&price_from=40000&price_to=&year_from=&year_to=&door_num=&submit_1=&without_price=1&date_limit=&showOldNew=all&modeltxt=&engine_volume_from=&engine_volume_to=&power_from=&power_to=&mileage_from=&mileage_to=&emission_class=&seat_num=&wheel_side=&registration=&country=&city=&page=&sort=";
        $html = HtmlDomParser::file_get_html($url, false, null, 0);
        $this->getAllCars($html);
    }

    public function update(Request $request, $category)
    {
        $this->validate($request, [
            'ime' => 'required'
        ]);
        $cat = Category::find($category);
        $cat->ime = $request->get('ime');
        $cat->save();
        return redirect()->route('categories');
    }

    public function delete($category)
    {
        $cat = Category::find($category);
        $cat->delete();
        return response()->json('All ok', 200);
    }

    private function getAllCars($dom)
    {
        foreach ($dom->find('article.single-classified') as $car)
        {
            var_dump($car->find('.uk-width-1-2.padding-left-10'));
            var_dump(count($car->childNodes()));
            var_dump($car->firstChild()->firstChild()->firstChild()->text());
            var_dump($car->lastChild()->lastChild()->firstChild()->firstChild()->firstChild()->text());
            die();
        }
    }

}
