@include('layouts.Admin.header')

<div class="container mt-4">

    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

    <a href="/admin/orders" class="btn btn-secondary mb-3">
        ← Quay lại
    </a>

    {{-- THÔNG TIN KHÁCH HÀNG --}}
    <div class="card mb-3">
        <div class="card-header bg-dark text-white">
            Thông tin khách hàng
        </div>

        <div class="card-body">
            {{-- ✅ LẤY TỪ ORDER --}}
            <p><b>Tên:</b> {{ $order->ho_ten }}</p>

            <p><b>SĐT:</b> {{ $order->so_dien_thoai }}</p>

            <p><b>Địa chỉ:</b> {{ $order->dia_chi }}</p>

            <p><b>Email:</b> {{ $order->user->email ?? '' }}</p>
        </div>
    </div>

    {{-- THÔNG TIN ĐƠN --}}
    <div class="card mb-3">
        <div class="card-header bg-info text-white">
            Thông tin đơn hàng
        </div>

        <div class="card-body">
            <p><b>Tổng tiền:</b> 
                <span class="text-danger">{{ number_format($order->tong_tien) }}đ</span>
            </p>

            <p><b>Trạng thái:</b> {{ $order->trang_thai }}</p>

            <p><b>Thanh toán:</b> {{ $order->payment_method }}</p>

            <p><b>Ngày tạo:</b> {{ $order->created_at }}</p>
        </div>
    </div>

    {{-- CHI TIẾT SẢN PHẨM --}}
    <div class="card">
        <div class="card-header bg-success text-white">
            Sản phẩm trong đơn
        </div>

        <div class="card-body">

            @if($order->orderDetails && count($order->orderDetails) > 0)

            <table class="table table-bordered text-center">
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>

                @foreach($order->orderDetails as $item)
                <tr>
                    <td>{{ $item->id }}</td>

                    <td>{{ $item->ten_san_pham }}</td>

                    <td>{{ number_format($item->gia) }}đ</td>

                    <td>{{ $item->so_luong }}</td>

                    <td class="text-danger">
                        {{ number_format($item->gia * $item->so_luong) }}đ
                    </td>
                </tr>
                @endforeach

            </table>

            @else
                <p>Không có sản phẩm nào.</p>
            @endif

        </div>
    </div>

</div>

@include('layouts.footer')