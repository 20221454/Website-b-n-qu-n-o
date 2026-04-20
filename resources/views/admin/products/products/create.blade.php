@include('layouts.Admin.header')
<div class="container mt-4">

    <h3>Thêm sản phẩm</h3>

    <form method="POST" action="/admin/products/store" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="ten_san_pham" class="form-control">
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="gia" class="form-control">
        </div>

        <div class="mb-3">
            <label>Ảnh</label>
            <input type="file" name="anh" class="form-control">
        </div>

        <div class="mb-3">
    <label>Danh mục</label>

    <select name="category_id" class="form-control" required>
        <option value="">-- Chọn danh mục --</option>

        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">
                {{ $cat->ten_danh_muc }}
            </option>
        @endforeach
    </select>
</div>

        <button class="btn btn-primary">
            Lưu sản phẩm
        </button>

    </form>

</div>

@include('layouts.footer')