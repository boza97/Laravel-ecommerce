<?php

namespace App\Http\Controllers;

use App\Product;

class CartController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('auth'); */
        $this->middleware('user')->except('store');
    }

    public function index(){
        $products = session('cart');

        return view('cart.index', compact('products'));
    }

    public function store(){

        if(!auth()->user()){
            return 'Morate se prijaviti da bi dodali proizvod u korpu.';
        }
        
        if(auth()->user()->role != 'USER') {
            return 'Morate se prijaviti kao korisnik da bi dodali proizvod u korpu.';
        }

        $id = request('id');
        
        if(isset(session('cart')[$id])) {
            return 'Proizvod je već dodat u korpu.';
        }
        
        $product = Product::where('id', $id)->first();
        
        session()->push('cart.'.$id, $product->toArray());
    
        return 'Uspešno ste dodali proizvod u korpu.';
    }

    public function destroy($id){
        session()->pull('cart.'.$id);

        if(empty(session('cart')))
            return 0;        
        
        return 1;
    }

}
