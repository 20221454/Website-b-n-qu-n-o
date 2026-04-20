@include('layouts.User.header')

<h3>Chi tiết đơn hàng #{{ $order->id }}</h3>

<p>Trạng thái: <b>{{ $order->trang_thai }}</b></p>

<table class="table">
    <tr>
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>SL</th>
        <th>Tổng</th>
    </tr>

    @foreach($order->orderDetails as $item)
    <tr>
        <td>{{ $item->product->ten_san_pham ?? '' }}</td>
        <td>{{ number_format($item->gia) }}</td>
        <td>{{ $item->so_luong }}</td>
        <td>{{ number_format($item->gia * $item->so_luong) }}</td>
    </tr>
    @endforeach
</table>

<h4 class="text-end">Tổng: {{ number_format($order->tong_tien) }}đ</h4>

@include('layouts.footer')