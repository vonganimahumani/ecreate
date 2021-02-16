<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response = Http::get('http://data.fixer.io/api/latest?access_key=788a53dcf36db5b679c8fb28708e8411');
        $rates = collect($response->json()['rates']);

        $collection = $rates->each(function ($item, $key) {
            var_dump($item . '///// ' . $key);
        });
        // dd(collect($rates->toArray()));
        return view('home',compact('rates'));
    }
}
