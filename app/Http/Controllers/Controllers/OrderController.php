<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 📌 Trang thanh toán
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/gio-hang')->with('error', 'Giỏ hàng trống');
        }

        return view('user.thanhtoan', compact('cart'));
    }

    // 📌 Xử lý đặt hàng
    public function store(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required',
            'so_dien_thoai' => 'required',
            'dia_chi' => 'required'
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/gio-hang');
        }

        $tong = 0;
        foreach ($cart as $item) {
            $tong += $item['gia'] * $item['so_luong'];
        }

        // ✅ Lưu đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'ho_ten' => $request->ho_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'tong_tien' => $tong,
            'trang_thai' => 'cho_xu_ly',
            'payment_method' => $request->payment_method,
        ]);

        // ✅ Lưu chi tiết
        foreach ($cart as $id => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'ten_san_pham' => $item['ten_san_pham'], // 🔥 bắt buộc có
                'gia' => $item['gia'],
                'so_luong' => $item['so_luong']
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', '🎉 Đặt hàng thành công!');
    }

    // 📌 Danh sách đơn hàng
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('user.donhang', compact('orders'));
    }

    // 📌 Chi tiết đơn hàng
    public function detail($id)
    {
        $order = Order::with('orderDetails')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.chitiet_donhang', compact('order'));
    }

    // 📌 Hủy đơn
    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($order->trang_thai == 'cho_xu_ly') {
            $order->trang_thai = 'huy';
            $order->save();
        }

        return back()->with('success', 'Đã hủy đơn');
    }
}