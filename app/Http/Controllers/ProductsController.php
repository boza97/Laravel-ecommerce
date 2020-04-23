<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

class ProductsController extends Controller
{
    
    public function index(){
        
        $products = Product::get();
        $categories = Category::get();
        return view('products.index', compact('products', 'categories'));
    }

    public function productsByCategory($id) {
        if($id === '*')
            $products = Product::where('quantity', '>', 0)->get();
        else
            $products = Product::where('quantity', '>', 0)->where('category_id', $id)->get();

        return view('products.by_category', compact('products'));        
    }

    public function show($id){
        $product = Product::where('products.id', $id)
                            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                            ->select('products.*', 'categories.category_name')->first();
        
        return view('products.show', compact('product'));
    }
}
