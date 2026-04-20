<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 📌 Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.giohang', compact('cart'));
    }

    // 📌 Thêm vào giỏ
    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['so_luong']++;
        } else {
            $cart[$id] = [
                'ten_san_pham' => $product->ten_san_pham,
                'gia' => $product->gia,
                'anh' => $product->anh,
                'so_luong' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect('/gio-hang')->with('success', 'Đã thêm vào giỏ');
    }

    // 📌 Xóa
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect('/gio-hang');
    }

    // 📌 Cập nhật số lượng
    public function update($id, $qty)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] = max(1, (int)$qty);
            session()->put('cart', $cart);
        }

        return redirect('/gio-hang');
    }
}