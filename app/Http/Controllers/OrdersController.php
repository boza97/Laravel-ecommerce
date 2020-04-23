<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    public function index(){
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->get();

        foreach ($orders as $k => $v) {
            $v->order_items = OrderItem::where('order_items.order_id', $v->id)
                                ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
                                ->get();
        }

        return view('orders.index', compact('orders'));
    }

    public function destroy(){
        $validator = request()->validate([
            'orderid' => 'required',
            'date' => 'required'
        ]);

        $currentTime = date('Y-m-d H:i:s');
        $cancelTime = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($validator['date'])));

        if($currentTime > $cancelTime)
            return back()->with('error', 'Vreme za otkazivanje narudžbine je isteklo');

        DB::beginTransaction();
        try {
            Order::where('id', $validator['orderid'])->delete();
            OrderItem::where('order_id', $validator['orderid'])->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders')->with('error', 'Greska prilikom brisanja narudžbine');
        }        

        return back()->with('success', 'Uspešno obrisana narudžbina');
    }

    public function addQuantity(){
        $products_ids = request('productid');
        $products_totals = request('quantity');

        foreach ($products_totals as $k => $q) {
            session()->push('cart.'.$products_ids[$k], ['orderedQuantity' => $q]);
        }

        return redirect()->route('order');
    }

    public function order(){
        if(empty(session('cart'))){
            return redirect()->route('cart');
        }
        return view('orders.order');
    }

    public function store(){
        $validator = request()->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string', 
            'phone' => 'required|string'
        ]);

        $total = 0;
        foreach (session('cart') as $k => $v) {
            $total += $v[0]['price'] * $v[1]['orderedQuantity'];
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'name' => $validator['name'],
                'city' => $validator['city'],
                'address' => $validator['address'],
                'phone' => $validator['phone'],
                'total' => $total
            ]);
    
            foreach (session('cart') as $k => $v) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $v[0]['id'],
                    'quantity' => $v[1]['orderedQuantity'],
                    'amount' => $v[0]['price'] * $v[1]['orderedQuantity']
                ]);
    
                $p = Product::where('id', $v[0]['id'])->first();
    
                $quan = $p->quantity - $v[1]['orderedQuantity'];
    
                $p->quantity = $quan;
                $p->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart')->with('error', 'Došlo je do greške');
        }        

        session()->pull('cart');

        return redirect()->route('orders')->with('success', 'Uspešno dodata narudžbina.');
    }
}
