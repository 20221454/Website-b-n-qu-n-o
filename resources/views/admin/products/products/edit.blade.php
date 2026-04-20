@include('layouts.Admin.header')

<div class="container mt-4">

    <h3>Sửa sản phẩm</h3>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="ten_san_pham" class="form-control"
                   value="{{ $product->ten_san_pham }}">
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="gia" class="form-control"
                   value="{{ $product->gia }}">
        </div>

        <div class="mb-3">
            <label>Ảnh hiện tại</label><br>
            @if($product->anh)
                <img src="{{ asset('uploads/' . $product->anh) }}" width="120">
            @endif
        </div>

        <div class="mb-3">
            <label>Đổi ảnh</label>
            <input type="file" name="anh" class="form-control">
        </div>

        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category_id" class="form-control">

                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->ten_danh_muc }}
                    </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-primary">
            Cập nhật
        </button>

    </form>

</div>