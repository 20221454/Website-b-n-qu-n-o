<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 📌 Danh sách sản phẩm + filter
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $categories = Category::all();

        $query = Product::with('category');

        // 🔎 tìm kiếm
        if ($search) {
            $query->where('ten_san_pham', 'like', "%$search%");
        }

        // 🗂 lọc danh mục
        if ($category) {
            $query->where('category_id', $category);
        }

        $products = $query
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('user.sanpham', compact(
            'products',
            'categories',
            'search',
            'category'
        ));
    }

    // 📌 chi tiết sản phẩm
    public function detail($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('user.chitiet', compact('product'));
    }
}