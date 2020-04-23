<?php

namespace App\Http\Controllers;

use App\Product;
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
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $products = Product::where('featured', 1)
                            ->where('quantity', '>', 0)                    
                            ->get(); */

        $res = callAPI('GET', env('APP_URL') .'/api/products/featured');
        
        $products = $res->products;

        return view('home', compact('products'));
    }
}
