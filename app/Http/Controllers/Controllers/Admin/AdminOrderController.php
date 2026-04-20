<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // 📌 Danh sách đơn hàng
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // 📌 Chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('orderDetails', 'user')
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    // 📌 Cập nhật trạng thái (FIX CHUẨN)
    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);

        $validStatus = [
            'cho_xu_ly',
            'da_xac_nhan',
            'dang_giao',
            'da_giao',
            'huy'
        ];

        if (!in_array($status, $validStatus)) {
            return back()->with('error', 'Trạng thái không hợp lệ');
        }

        $order->trang_thai = $status;
        $order->save();

        return back()->with('success', 'Cập nhật thành công');
    }
}