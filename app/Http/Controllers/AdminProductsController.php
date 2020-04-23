<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.editor');
    }

    public function index(){
        $query = '%' . request('search') . '%';

        $products = Product::where('products.product_name', 'LIKE', $query)
                            ->leftJoin('categories', 'products.category_id', 'categories.id')
                            ->select('products.*', 'categories.category_name')
                            ->orderBy('products.product_name', 'DESC')
                            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function featured($id, $featured) {
        $product = Product::where('id', $id)->first();

        if(!$product) {
            return redirect()->route('adminProducts')->with('error', 'Proizvod ne postoji.');
        }

        if(!in_array($featured, [0,1])) {
            return redirect()->route('adminProducts')->with('error', 'Parametar izdvojen nije validan.');
        }

        $product->featured = $featured;
        $product->save();

        return redirect()->route('adminProducts')->with('success', 'Proizvod je ažuriran.');
    }

    public function create() {
        $categories = Category::get();

        return view('admin.products.create', compact('categories'));
    }

    public function store() {
        $validator = request()->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|exists:categories,id',
            'details' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $product = Product::create([
            'product_name' => $validator['product_name'],
            'price' => $validator['price'],
            'details' => $validator['details'],
            'category_id' => $validator['category'],
            'featured' => 0,
            'quantity' => $validator['quantity']
        ]);

        if(request('image')){
            $imageName = $product->id . '.' . request()->image->getClientOriginalExtension();
            $product->image = $imageName;
            request()->image->move(public_path('img/products'), $imageName);
        }
        
        $product->save();

        return redirect()->route('adminProducts')->with('success', 'Uspešno ste dodali proizvod.');
    }

    
    public function edit($id) {
        $product = Product::where('id', $id)->first();
        $categories = Category::get();

        if(!$product) {
            return redirect()->route('adminProducts')->with('error', 'Proizvod ne postoji.');
        }

        return view('admin.products.edit', compact('product', 'categories'));
    }

    
    public function deleteImage($id) {
        $product = Product::where('id', $id)->first();

        $image_path = public_path('img/products/'.$product->image);

        if(file_exists($image_path)) {
            File::delete($image_path);
        }

        $product->image = null;
        $product->save();

        return redirect()->route('adminEditProduct', $product->id);
    }

    public function update($id) {
        $validator = request()->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|exists:categories,id',
            'details' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $product = Product::where('id', $id)->first();

        if(!$product) {
            return redirect()->route('adminProducts')->with('error', 'Proizvod ne postoji.');
        }

        $product->product_name = $validator['product_name'];
        $product->price = $validator['price'];
        $product->quantity = $validator['quantity'];
        $product->category_id = $validator['category'];
        $product->details = $validator['details'];

        if(request('image')){
            $imageName = $product->id . '.' . request()->image->getClientOriginalExtension();
            $product->image = $imageName;
            request()->image->move(public_path('img/products'), $imageName);
        }
        
        $product->save();

        return redirect()->route('adminProducts')->with('success', 'Uspešno ste izmenili proizvod.');
    }
}
