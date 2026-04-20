<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 📌 Danh sách sản phẩm
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    // 📌 Form thêm
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    // 📌 Lưu sản phẩm
    public function store(Request $request)
    {
        $request->validate([
            'ten_san_pham' => 'required|string|max:255',
            'gia' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'anh' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $filename = null;

        // upload ảnh
        if ($request->hasFile('anh')) {
            $file = $request->file('anh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
        }

        Product::create([
            'ten_san_pham' => $request->ten_san_pham,
            'gia' => $request->gia,
            'category_id' => $request->category_id,
            'anh' => $filename
        ]);

        return redirect('/admin/products')->with('success', 'Thêm sản phẩm thành công');
    }

    // 📌 Form sửa
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 📌 Cập nhật
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'ten_san_pham' => 'required|string|max:255',
            'gia' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'anh' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $data = [
            'ten_san_pham' => $request->ten_san_pham,
            'gia' => $request->gia,
            'category_id' => $request->category_id,
        ];

        // upload ảnh mới
        if ($request->hasFile('anh')) {

            // xóa ảnh cũ
            if ($product->anh && file_exists(public_path('uploads/' . $product->anh))) {
                unlink(public_path('uploads/' . $product->anh));
            }

            $file = $request->file('anh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $data['anh'] = $filename;
        }

        $product->update($data);

        return redirect('/admin/products')->with('success', 'Cập nhật thành công');
    }

    // 📌 Xóa
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->anh && file_exists(public_path('uploads/' . $product->anh))) {
            unlink(public_path('uploads/' . $product->anh));
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Xóa thành công');
    }
}