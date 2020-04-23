<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use Illuminate\Validation\Rule;

class AdminOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.editor');
    }

    public function index(){
        $query = '%' . request('search') . '%';

        $orders = Order::where(function ($q) use ($query) {
                            $q->where('name', 'LIKE', $query)
                                  ->orWhere('status', 'LIKE', $query)
                                  ->orWhere('id', 'LIKE', $query);
                        })
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id) {
        $order = Order::where('id', $id)->first();

        if(!$order) {
            return redirect()->route('adminOrders')->with('error', 'Narudžbina ne postoji.');
        }

        $orderItems = OrderItem::where('order_items.order_id', $id)
                                ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
                                ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                                ->select('order_items.*', 'products.product_name', 'categories.category_name')
                                ->get();

        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    public function update($id) {
        $order = Order::where('id', $id)->first();

        if(!$order) {
            return back()->with('error', 'Narudžbina ne postoji.');
        }

        $validator = request()->validate([
            'status' => ['required', Rule::in(config('constants.order_statuses'))]
        ]);

        $order->status = $validator['status'];

        $order->save();

        return redirect()->route('adminOrderShow', $id)->with('success', 'Status je uspešno ažuriran.');
    }
}
