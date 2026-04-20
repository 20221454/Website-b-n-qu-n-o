<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->trang_thai = $status;
        $order->save();

        return back()->with('success','Cập nhật thành công');
    }
    public function detail($id)
{
    $order = Order::with('orderDetails.product')->findOrFail($id);

    return view('admin.orders.detail', compact('order'));
}
}