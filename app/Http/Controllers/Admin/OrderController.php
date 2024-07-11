<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request){
        $status = $request->status;
        $order_id = $request->order_id;
        $orders = Order::when($order_id, function($query, $order_id){
            $query->where('id', $order_id);
        })->orderByDesc('id');

        if(isset($status)){
            $orders = $orders->where('status', $status);
        }
        $orders = $orders->paginate(10);
        return view('admin.order.list', compact('orders'));
    }

    public function show(Order $order){
        return view('admin.order.show', compact('order'));
    }

    public function confirm(Order $order){
        $order->status = 3;
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được xác nhận.');
    }

    public function delivered(Order $order){
        $order->status = 4;
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được giao.');
    }

    public function back(Order $order){
        $order->status = 1;
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hoàn trả.');
    }
}
