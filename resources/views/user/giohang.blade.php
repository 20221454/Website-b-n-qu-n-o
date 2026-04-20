@include('layouts.User.header')

<h2 class="mb-4">🛒 Giỏ hàng</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(empty($cart))
    <p>Giỏ hàng của bạn đang trống.</p>
    <a href="/san-pham" class="btn btn-primary">Tiếp tục mua sắm</a>
@else

<table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>Ảnh</th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Xóa</th>
        </tr>
    </thead>

    <tbody>
        @php $tong = 0; @endphp

        @foreach($cart as $id => $item)
            @php 
                $total = $item['gia'] * $item['so_luong']; 
                $tong += $total;
            @endphp

        <tr>
            <td width="100">
                @if(!empty($item['anh']))
                    <img src="/uploads/{{ $item['anh'] }}" width="80">
                @else
                    <img src="https://via.placeholder.com/80">
                @endif
            </td>

            <td>{{ $item['ten_san_pham'] }}</td>

            <td class="text-danger">
                {{ number_format($item['gia']) }}đ
            </td>

            <td width="150">
                <div class="d-flex justify-content-center">
                    <a href="/cap-nhat-gio-hang/{{ $id }}/{{ $item['so_luong'] - 1 }}" 
                       class="btn btn-sm btn-secondary">-</a>

                    <span class="mx-2">{{ $item['so_luong'] }}</span>

                    <a href="/cap-nhat-gio-hang/{{ $id }}/{{ $item['so_luong'] + 1 }}" 
                       class="btn btn-sm btn-secondary">+</a>
                </div>
            </td>

            <td>
                {{ number_format($total) }}đ
            </td>

            <td>
                <a href="/xoa-gio-hang/{{ $id }}" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Xóa sản phẩm này?')">
                   Xóa
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

<h4 class="text-end">Tổng tiền: 
    <span class="text-danger">{{ number_format($tong) }}đ</span>
</h4>

<div class="d-flex justify-content-between">
    <a href="/san-pham" class="btn btn-secondary">
        ← Tiếp tục mua
    </a>

    <a href="/thanh-toan" class="btn btn-success">
        Thanh toán →
    </a>
</div>

@endif

@include('layouts.footer')