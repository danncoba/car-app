<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = (int)$request->query('page');
        $skip = ($page-1)*20;
        $cars = DB::table('cars')
            ->orderBy('created_at', 'DESC')
            ->skip($skip)->take(20)->get();
        $count = DB::table('cars')->count();
        return response()->json(array('cars' => $cars, 'count' => $count));
    }
}
