@include('layouts.User.header')

<div class="row">
    <div class="col-md-5">
        <img src="{{ asset('uploads/'.$product->anh) }}" class="img-fluid">
    </div>

    <div class="col-md-7">
        <h3>{{ $product->ten_san_pham }}</h3>
        <h4 class="text-danger">{{ number_format($product->gia) }}đ</h4>

        <p>{{ $product->mo_ta }}</p>

        <p>Danh mục: {{ $product->category->ten_danh_muc ?? '' }}</p>

        <a href="/them-gio-hang/{{ $product->id }}" class="btn btn-success">
            Thêm vào giỏ hàng
        </a>
    </div>
</div>

@include('layouts.footer')